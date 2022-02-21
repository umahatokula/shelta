<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Models\Transaction;
use Livewire\WithFileUploads;

class TransactionsEdit extends Component
{
    use WithFileUploads;

    public  $client_id,
            $property_id,
            $amount,
            $type,
            $proof,
            $proof_reference_number,
            $transaction_number,
            $date,
            $instalment_date,
            $recorded_by,
            $status,
            $is_approved;

    public $propertybalance = 0;
    public Client $client;
    public Transaction $transaction;

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
     * mount
     *
     * @param  mixed $client
     * @return void
     */
    public function mount(Client $client, Transaction $transaction) {

        $this->transaction = $transaction;
        $this->client_id = $transaction->client_id;
        $this->property_id = $transaction->property_id;
        $this->amount = $transaction->amount;
        $this->type = $transaction->type;
        $this->proof_reference_number = $transaction->proof_reference_number;
        $this->transaction_number = $transaction->transaction_number;
        $this->date = $transaction->date;
        $this->instalment_date = $transaction->instalment_date;
        $this->recorded_by = $transaction->recorded_by;
        $this->status = $transaction->status;
        $this->is_approved = $transaction->is_approved;

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
 
        $this->transaction->update([
            'client_id'              => $this->client_id,
            'property_id'            => $this->property_id,
            'amount'                 => $this->amount,
            'type'                   => 'recorded',
            'proof_reference_number' => $this->proof_reference_number,
            'transaction_number'     => substr(hash('sha256', mt_rand() . microtime()), 0, 20),
            'date'                   => $this->date,
            'instalment_date'        => $this->instalment_date,
            'recorded_by'            => auth()->id(),
            'status'                 => $this->status,
            'is_approved'            => $this->is_approved,
        ]);

        // set new date for next payment
        $property = $this->transaction->property;
        $property->next_due_date = $this->transaction->property->nextPaymentDueDate();
        $property->save();

        if ($this->proof) {
            $this->transaction
            ->addMedia($this->proof->getRealPath())
            ->usingName($this->proof->getClientOriginalName())
            ->toMediaCollection('proofOfPayment', 'public');
        }

        // set date of first transaction
        $property = Property::where('id', $this->transaction->property_id)->first();

        if (!$property->date_of_first_payment) {
            $property->date_of_first_payment = $this->transaction->date;
            $property->save();
        }

        // log this transaction
        activity()
            ->by(auth()->user())
            ->on($this->transaction)
            ->withProperties(['is_staff' => true])
            ->log('payment recorded');

        // session()->flash('message', 'Payment successful.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment updated.']);

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.transactions.transactions-edit');
    }
}
