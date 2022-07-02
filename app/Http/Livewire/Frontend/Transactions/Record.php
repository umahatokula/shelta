<?php

namespace App\Http\Livewire\Frontend\Transactions;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\Transaction;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Record extends Component
{
    use WithFileUploads;

    public $client_id, $property_id, $amount, $instalment_date, $proof, $proof_reference_number;
    public $propertybalance = 0;
    public Client $client;

    protected $rules = [
        'client_id'   => 'required',
        'property_id' => 'required',
        'amount'      => 'required',
        'instalment_date'      => 'required',
        // 'proof'      => 'required|max:1024|mimes:jpg,png,pdf,jpeg', // 1MB Max',
        // 'proof_reference_number' => 'required|unique:transactions'
    ];

    protected $messages = [
        'property_id.required' => 'Please select a property',
        'amount.required' => 'Please enter an amount',
        'instalment_date.required' => 'Please select a payment date',
        'proof.required' => 'Please upload a proof of payment',
        'proof_reference_number.required' => 'The Proof of Payment Ref number os required',
        'proof_reference_number.unique' => 'This Ref number has already been recorded',
    ];


    /**
     * updated
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    /**
     * onSelectProperty
     *
     * @param  mixed $property
     * @return void
     */
    public function onSelectProperty(Property $property) {

        $estatePropertyTypePrice = $property->estatePropertyType->estatePropertyTypePrices->filter(function($price) use($property) {
            return $price->payment_plan_id == $property->payment_plan_id;
        })->first();

        if (!$estatePropertyTypePrice) {
            $this->addError('amount', 'Property balance could not be determined. Contact admin.');
            return;
        }

        $propertyPrice = $estatePropertyTypePrice->propertyPrice;


        if (!$propertyPrice) {
            $this->addError('amount', 'Property balance could not be determined. Contact admin.');
            return;
        }

        $price = $propertyPrice->price;

        $this->propertybalance = $price - $property->totalPaid();

        $this->instalment_date = $property->nextPaymentDueDate() ? $property->nextPaymentDueDate()->format('Y-m-d') : null;
    }

    /**
     * mount
     *
     * @param  mixed $client
     * @return void
     */
    public function mount(Client $client) {
        $this->client_id = $client->id;
        $this->client = $client->load(['properties.estatePropertyType.propertyType', 'properties.estatePropertyType.estate']);
    }

    /**
     * save
     *
     * @return void
     */
    public function save() {

        $this->validate();

        $transaction = Transaction::create([
            'client_id'              => $this->client_id,
            'property_id'            => $this->property_id,
            'amount'                 => $this->amount,
            'type'                   => 'recorded',
            'proof_reference_number' => $this->proof_reference_number,
            'transaction_number'     => substr(hash('sha256', mt_rand() . microtime()), 0, 20),
            'date'                   => Carbon::now(),
            'instalment_date'        => Transaction::getFormattedInstalemtDate($this->instalment_date),
            'recorded_by'            => auth()->id(),
            'status'                 => 3,
            'is_approved'            => 0,
        ]);

        if ($this->proof) {
            $transaction
            ->addMedia($this->proof->getRealPath())
            ->usingName($this->proof->getClientOriginalName())
            ->toMediaCollection('proofOfPayment', 'public');
        }


        // set date of first transaction
        $property = Property::where('id', $transaction->property_id)->first();

        if (!$property->date_of_first_payment) {
            $transaction->is_first_instalment = true;
        }

        // log this transaction
        activity()
            ->by(auth()->user())
            ->on($transaction)
            ->withProperties(['is_staff' => true])
            ->log('payment recorded');

        // session()->flash('message', 'Payment successful.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment recorded.']);

        redirect()->route('frontend.clients.payments');
    }

    public function render()
    {
        return view('livewire.frontend.transactions.record');
    }
}
