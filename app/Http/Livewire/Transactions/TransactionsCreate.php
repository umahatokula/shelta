<?php

namespace App\Http\Livewire\Transactions;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\Transaction;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class TransactionsCreate extends Modal
{
    use WithFileUploads;

    public $client_id, $property_id, $amount, $date, $proof, $proof_reference_number, $instalment_date;
    public $propertybalance = 0;
    public Client $client;

    protected $rules = [
        'client_id'   => 'required',
        'property_id' => 'required',
        'amount'      => 'required',
        'date'      => 'required',
        // 'proof'      => 'required|max:1024|mimes:jpg,png,pdf,jpeg', // 1MB Max',
        // 'proof_reference_number' => 'required|unique:transactions'
    ];
 
    protected $messages = [
        'property_id.required' => 'Please select a property',
        'amount.required' => 'Please enter an amount',
        'date.required' => 'Please select a payment date',
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

        $propertyPrice = $property->estatePropertyType->estatePropertyTypePrices->filter(function($price) use($property) {
            return $price->payment_plan_id == $property->payment_plan_id;
        })->first()->propertyPrice->price;
        
        $this->propertybalance = $propertyPrice - $property->totalPaid();
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
            'date'                   => $this->date,
            'instalment_date'        => $this->instalment_date,
            'recorded_by'            => auth()->id(),
            'status'                 => 3,
            'is_approved'            => 0,
        ]);

        // set new date for next payment
        $property = $transaction->property;
        $property->next_due_date = $transaction->property->nextPaymentDueDate();
        $property->save();

        if ($this->proof) {
            $transaction
            ->addMedia($this->proof->getRealPath())
            ->usingName($this->proof->getClientOriginalName())
            ->toMediaCollection('proofOfPayment', 'public');
        }

        // set date of first transaction
        $property = Property::where('id', $transaction->property_id)->first();

        if (!$property->date_of_first_payment) {
            $property->date_of_first_payment = $transaction->date;
            $property->save();
        }

        // log this transaction
        activity()
            ->by(auth()->user())
            ->on($transaction)
            ->withProperties(['is_staff' => true])
            ->log('payment recorded');

        // session()->flash('message', 'Payment successful.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment recorded.']);

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.transactions.transactions-create', [
            'client' => Client::first()
        ]);
    }
}
