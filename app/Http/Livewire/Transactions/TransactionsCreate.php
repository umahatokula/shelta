<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class TransactionsCreate extends Modal
{
    use WithFileUploads;

    public $client_id, $property_id, $amount, $date, $proof;
    public Client $client;

    protected $rules = [
        'client_id'   => 'required',
        'property_id' => 'required',
        'amount'      => 'required',
        'proof'      => 'required|max:1024|mimes:jpg,png,pdf,jpeg', // 1MB Max',
    ];
 
    protected $messages = [
        'property_id.required' => 'Please select a property',
        'amount.required' => 'Please enter an amount',
        'proof.required' => 'Please upload a proof of payment',
    ];
 
    public function mount(Client $client) {
        $this->client_id = $client->id;
        $this->client = $client->load(['properties.estatePropertyType.propertyType', 'properties.estatePropertyType.estate']);
    }
 
    public function save()
    {
        $this->validate();
 
        $transaction = Transaction::create([
            'client_id'          => $this->client_id,
            'property_id'        => $this->property_id,
            'amount'             => $this->amount,
            'type'               => 'cr',
            'transaction_number' => substr(hash('sha256', mt_rand() . microtime()), 0, 20),
            'date'               => $this->date,
        ]);

        $transaction
            ->addMedia($this->proof->getRealPath())
            ->usingName($this->proof->getClientOriginalName())
            ->toMediaCollection('proofOfPayment', 'public');

        session()->flash('message', 'Payment successful.');

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.transactions.transactions-create', [
            'client' => Client::first()
        ]);
    }
}
