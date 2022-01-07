<?php

namespace App\Http\Livewire\Parcelation;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use App\Models\OnlinePayment;
use App\Models\EstatePropertyType;
use Illuminate\Support\Facades\DB;
use App\Events\ClientPropertiesUpdated;

class Pay extends Component
{    
    public Client $client;
    public $payingName, $payingEmail, $payingAmount;
    public $propertybalance = 0;
    public $property;
    public $properties;
    public $paymentPlans;
    public $allPaymentPlans, $key; 
    public $clientProperties = [];
    public $propertyisUnallocated = true;

    public $listeners = ['frontendOnlinePaymentOnPlotSelectionSuccessful', 'plotPaymentSuccessful'];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(Property $property) {

        // check if property is already assigned
        if ($property->client_id) {

            $this->propertyisUnallocated = false;
            $this->client = new Client;

            return;
        }

        $this->property = $property;
        $this->properties[] = $property;
        $this->client = auth()->user()->client;

        $propertyWithPrice = $property->estatePropertyType->estatePropertyTypePrices->filter(function($price) use($property) {
            return !is_null($price->payment_plan_id);
        })->first();
        
        if(!$propertyWithPrice) {
            session()->flash('danger', 'Selected property doesn\'t have a price tag. Transaction cannot be completed.');
            return;
        }

        $propertyPrice = $propertyWithPrice->propertyPrice->price;
        $this->propertybalance = $propertyPrice - $property->totalPaid();

        // get estate id and property type id of this property
        $property_type_id = null;
        $estate_id = null;
        $this->key = 0;
        
        if($property->estatePropertyType) {
            $property_type_id = $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->id : null;
            $estate_id = $property->estatePropertyType->estate ? $property->estatePropertyType->estate->id : null;
        }

        $this->allPaymentPlans  = PaymentPlan::all();
        $this->paymentPlans[$this->key] = [];
        $this->getPaymentPlans($this->key, $estate_id, $property_type_id);
        
    }
    
    /**
     * onSelectPaymentPlan
     *
     * @param  mixed $paymentPlanId
     * @return void
     */
    public function onSelectPaymentPlan($paymentPlanId) {

        $propertyPrice = $this->property->estatePropertyType->estatePropertyTypePrices->filter(function($price) use ($paymentPlanId) {
            return $price->payment_plan_id == $paymentPlanId;
        })->first()->propertyPrice->price;

        $this->propertybalance = $propertyPrice - $this->property->totalPaid();
    }

    /**
     * Get Payment Plans for the selected estate and property type
     *
     * @param  mixed $key
     * @param  mixed $estate_id
     * @param  mixed $propertyType_id
     * @return void
     */
    public function getPaymentPlans($key, $estate_id, $propertyType_id) {
        if (!$estate_id || !$propertyType_id) {
            return;
        }
        array_key_exists($key, $this->paymentPlans) ? array_splice($this->paymentPlans, $key, 1) : null; // remove existing payment plan at $key

        $estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate_id,
            'property_type_id' => $propertyType_id,
        ])->first();
        
        $estatePropertyTypePrices = $estatePropertyType ? $estatePropertyType->estatePropertyTypePrices : collect([]);

        $estatePropertyTypeIDs = $estatePropertyTypePrices->map(function($estatePropertyTypePrice) {
            return $this->allPaymentPlans->where('id', $estatePropertyTypePrice->payment_plan_id);
        });
        
        foreach (Arr::flatten($estatePropertyTypeIDs) as $paymentPlan) {
            $this->paymentPlans[$key][] = $paymentPlan->toArray();
        }
    }
    
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
     * onlinePaymentSuccessful
     *
     * @param  mixed $data
     * @return void
     */
    public function frontendOnlinePaymentOnPlotSelectionSuccessful(Array $data) {
        // dd($data);
 
        $transaction = null;
        DB::transaction(function () use($data, &$transaction) {
            if ($data['status'] === 'success') {

                // persist transaction
                $transaction = Transaction::create([
                    'client_id'          => $data['client_id'],
                    'property_id'        => $data['property_id'],
                    'amount'             => $data['amount'],
                    'type'               => 'online',
                    'transaction_number' => $data['reference'],
                    'date'               => Carbon::now(),
                    'recorded_by'        => auth()->id(),
                    'status'             => 1,
                    'is_approved'        => 1,
                ]);
    
                // set date of first payment if this is the first payment
                if (Transaction::where('id', $transaction->id)->get()->count() === 1) {
                    Property::where('id', $transaction->property_id)->update([
                        'date_of_first_payment' => Carbon::now(),
                   ]);
                }

                // assign plot
                $assignedProperty[] = Property::where('id', $data['property_id'])->update([
                    'client_id'         => auth()->user()->client->id,
                    'payment_plan_id'   => $data['payment_plan_id'],
                ]);
        
                // dispatch events
                PaymentMade::dispatch($transaction);
                ClientPropertiesUpdated::dispatch(auth()->user()->client, $assignedProperty);
        
                $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully added.']);
        
                redirect()->route('frontend.clients.properties', $this->client->slug);
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

    }
    
    public function render()
    {
        return view('livewire.parcelation.pay');
    }
}
