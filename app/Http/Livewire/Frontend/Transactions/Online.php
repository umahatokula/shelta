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
        'frontendOnlinePaymentSuccessful',
        'emptyAmountField',
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
     * frontendOnlinePaymentSuccessful
     *
     * @param  mixed $data
     * @return void
     */
    public function frontendOnlinePaymentSuccessful(Array $data) {
        // dd($data);

        $transaction = null;
        DB::transaction(function () use($data, &$transaction) {
            if ($data['status'] === 'success') {
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

                if (Transaction::where('id', $transaction->id)->get()->count() === 1) {
                    Property::where('id', $transaction->property_id)->update([
                        'date_of_first_payment' => Carbon::now(),
                   ]);
                }
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

    public function emptyAmountField() {

        $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'The amount field is required']);
    }

    public function render()
    {
        return view('livewire.frontend.transactions.online');
    }
}
