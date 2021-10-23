<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;
use App\Http\Livewire\Modal;
use LivewireUI\Modal\ModalComponent;

class TransactionsCreate extends Modal
{
    public $client_id, $property_id, $amount, $date;
    public Client $client;

    protected $rules = [
        'client_id'   => 'required',
        'property_id' => 'required',
        'amount'      => 'required',
    ];
 
    protected $messages = [
        'property_id.required' => 'Please select a property',
        'amount.required' => 'Please enter an amount',
    ];
 
    public function mount(Client $client) {
        $this->client_id = $client->id;
        $this->client = $client->load(['properties.estatePropertyType.propertyType', 'properties.estatePropertyType.estate']);
    }
 
    public function save()
    {
        $this->validate();
 
        Transaction::create([
            'client_id'          => $this->client_id,
            'property_id'        => $this->property_id,
            'amount'             => $this->amount,
            'type'               => 'cr',
            'transaction_number' => substr(hash('sha256', mt_rand() . microtime()), 0, 20),
            'date'               => $this->date,
        ]);

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.transactions.transactions-create', [
            'client' => Client::first()
        ]);
    }
}
