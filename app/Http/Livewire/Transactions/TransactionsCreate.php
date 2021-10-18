<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;

class TransactionsCreate extends Component
{
    public $client_id, $property_id, $amount, $date;
    public Client $client;

    protected $rules = [
        'client_id'   => 'required',
        'property_id' => 'required',
        'amount'      => 'required',
    ];
 
    public function mount(Client $client) {
        $this->client_id = $client->id;
        $this->client = $client->load(['properties.estatePropertyType.propertyType', 'properties.estatePropertyType.estate']);
    }
 
    public function save()
    {
        $this->validate();
 
        Transaction::create([
            'client_id'   => $this->client_id,
            'property_id' => $this->property_id,
            'amount'      => $this->amount,
            'type'        => 'cr',
            'date'        => $this->date,
        ]);

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.transactions.transactions-create');
    }
}
