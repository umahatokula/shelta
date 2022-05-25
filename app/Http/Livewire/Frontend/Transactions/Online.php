<?php

namespace App\Http\Livewire\Frontend\Transactions;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\Transaction;
use App\Models\OnlinePayment;
use Illuminate\Support\Facades\DB;

class Online extends Component
{
    public Client $client;
    public $showOnlinePaymentForm = false;
    public $payingName, $payingEmail, $payingAmount;
    public $propertybalance = 0;

    protected $listeners = [
        'onlinePaymentSuccessful',
        'validateInput',
    ];

    /**
     * onSelectProperty
     *
     * @param  mixed $property
     * @return void
     */
    public function onSelectProperty(Property $property) {

        $propertyPrice = $property->estatePropertyType->estatePropertyTypePrices->filter(function($price) use($property) {
            return $price->payment_plan_id == $property->payment_plan_id;
        })->first()->propertyPrice->price;

        $this->propertybalance = $propertyPrice - $property->totalPaid();
    }

    /**
     * validate Input for online payment
     *
     * @param  mixed $data
     * @return void
     */
    public function validateInput(Array $data) {
        // dd($data);

        if (empty($data['client_id']) || empty($data['property_id']) || empty($data['amount'])) {

            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'Client, Property and Amount are ALL required']);
            return;

        }

        $property = Property::find($data['property_id']);
        if (!$property) {

            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'Property not found']);
            return;

        }

        // everything checks out. Validation is successful
        $this->dispatchBrowserEvent('onSuccessfulValidation');
    }

    /**
     * onlinePaymentSuccessful
     *
     * @param  mixed $data
     * @return void
     */
    public function onlinePaymentSuccessful(Array $data) {
        // dd($data);

        // check for existence of property before procedding
        $property = Property::find($data['property_id']);
        if (!$property) {
            session()->flash('error', 'Property '.$data['property_id'].' not found');
            return redirect()->back();
        }

        $transaction = null;
        DB::transaction(function () use($data, &$transaction, &$property) {
            if ($data['status'] === 'success') {

                $transaction = Transaction::create([
                    'client_id'          => $data['client_id'],
                    'property_id'        => $data['property_id'],
                    'amount'             => $data['amount'],
                    'type'               => 'online',
                    'transaction_number' => $data['reference'],
                    'date'               => Carbon::now(),
                    'instalment_date'    => $property->nextPaymentDueDate(),
                    'recorded_by'        => auth()->id(),
                    'status'             => 1,
                    'is_approved'        => 1,
                ]);

                // set date of first transaction
                if (!$property->date_of_first_payment) {

                    $property->date_of_first_payment = Carbon::now();
                    $property->save();

                    // update first transaction instalment date
                    $transaction->instalment_date = Carbon::now();
                    $transaction->is_first_instalment = true;
                    $transaction->save();
                }

                // set new date for next payment
                $property = $transaction->property;
                $property->next_due_date = $property->nextPaymentDueDate();
                $property->save();
            }

            OnlinePayment::create([
                'client_id'      => $data['client_id'],
                'transaction_id' => $transaction ? $transaction->id : null,
                'message'        => $data['message'],
                'reference'      => $data['reference'],
                'status'         => $data['status'],
                'amount'         => $data['amount'],
            ]);
        });

        // log this transaction
        activity()
            ->by(auth()->user())
            ->on($transaction)
            ->withProperties(['is_staff' => false])
            ->log('online payment');

        // dispatch event
        PaymentMade::dispatch($transaction);

        // session()->flash('message', 'Payment successful.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment successful']);

        redirect()->route('frontend.clients.payments');

    }

    /**
     * mount
     *
     * @param  mixed $client
     * @return void
     */
    public function mount(Client $client) {
        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType',
            'transactions.property.estatePropertyType.estate',
            'transactions.recordedBy',
            'properties.estatePropertyType.propertyType',
            'properties.estatePropertyType.estate'
        ]);
    }

    public function render()
    {
        return view('livewire.frontend.transactions.online');
    }
}
