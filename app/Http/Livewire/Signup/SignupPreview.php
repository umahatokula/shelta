<?php

namespace App\Http\Livewire\Signup;

use App\Events\ClientPropertiesUpdated;
use App\Events\PaymentMade;
use App\Models\Client;
use App\Models\Estate;
use App\Models\EstatePropertyType;
use App\Models\Gender;
use App\Models\LGA;
use App\Models\MaritalStatus;
use App\Models\OnlinePayment;
use App\Models\PaymentPlan;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class SignupPreview extends Component
{
    use WithFileUploads;

    public $estateId, $propertyTypeId, $paymentPlanId, $propertyPrice, $processingFee;
    public $property, $client, $estate, $propertyType, $paymentPlan;

    protected $listeners = [
        'onlinePaymentSuccessful',
        'validateInput',
    ];

    public function mount(Client $client, $estateId, $propertyTypeId, $paymentPlanId) {

        $this->estateId = $estateId;
        $this->propertyTypeId = $propertyTypeId;
        $this->paymentPlanId = $paymentPlanId;

        $this->client = $client;
        $this->estate = Estate::find($estateId);
        $this->propertyType = PropertyType::find($propertyTypeId);
        $this->paymentPlan = PaymentPlan::find($paymentPlanId);

        // get property
        $properties = $this->getAvailableProperties();
//        dd($properties);
        $this->property = $properties->first();
        $this->property->payment_plan_id = $this->paymentPlanId;
        $this->propertyPrice = $this->property->getMonthlyPaymentAmount();

        $this->processingFee = 10_000;

    }

    /**
     * onlinePaymentSuccessful
     *
     * @param  mixed $data
     * @return void
     */
    public function onlinePaymentSuccessful(Array $data) {

        // record transaction
        $this->recordTransaction($data);

        // add plots/properties to clients
        $this->updateClientProperties();

        // show notification
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment successful']);

        redirect()->route('signUp');

    }

    /**
     * Get Property belonging to payment plan
     *
     * @return void
     */
    public function getAvailableProperties() {
        return (new Property)->getUnallocatedAllocatedProperties($this->estateId, $this->propertyTypeId);
    }

    public function recordTransaction($data) {

        if (!$this->property) {
            return ;
        }

        $transaction = null;

        DB::transaction(function () use($data, &$transaction) {

            if ($data['status'] === 'success') {

                $transaction = Transaction::create([
                    'client_id'          => $this->client->id,
                    'property_id'        => $this->property->id,
                    'amount'             => $data['amount'],
                    'type'               => 'online',
                    'transaction_number' => $data['reference'],
                    'date'               => Carbon::now(),
                    'instalment_date'    => Carbon::now(),
                    'recorded_by'        => auth()->id(),
                    'status'             => 1,
                    'is_approved'        => 1,
                ]);

            }

            OnlinePayment::create([
                'client_id'      => $this->client->id,
                'transaction_id' => $transaction ? $transaction->id : null,
                'message'        => $data['message'],
                'reference'      => $data['reference'],
                'status'         => $data['status'],
                'amount'         => $data['amount'],
            ]);

        });

        // set date of first transaction
        if (!$this->property->date_of_first_payment) {

            $this->property->date_of_first_payment = Carbon::now();
            $this->property->save();

            // update first transaction instalment date
            $transaction->instalment_date = Carbon::now();
            $transaction->save();
        }

        // set new date for next payment
        $this->property = $transaction->property;
        $this->property->client_id = $this->client->id;
        $this->property->payment_plan_id = $this->paymentPlanId;
        $this->property->next_due_date = $this->property->nextPaymentDueDate();
        $this->property->save();

        // dispatch event
        PaymentMade::dispatch($transaction);
    }

    public function updateClientProperties() {

        Property::where('client_id', $this->client->id)->update(['client_id' => null]); // update clients existing properties

        Property::where('id', $this->property->id)->update([
            'client_id'               => $this->client->id,
            'payment_plan_id'         => $this->paymentPlanId,
        ]);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully added.']);

        ClientPropertiesUpdated::dispatch($this->client, collect($this->property)->toArray());

    }

    public function render()
    {
        return view('livewire.signup.signup-preview');
    }
}
