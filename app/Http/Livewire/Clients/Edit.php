<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Edit extends Component
{
    public $name, $phone, $email, $address, $client_id;
    public Client $client;

    public function mount(Client $client) {
        $this->name      = $client->name;
        $this->phone     = $client->phone;
        $this->email     = $client->email;
        $this->address   = $client->address;
        $this->client_id = $client->id;
    }

    protected $rules = [
        'name' => 'required|string|min:6',
        'phone' => 'required|string|max:500',
    ];
 
    public function save()
    {
        $this->validate();
 
        Client::where('id', $this->client_id)->update([
            'name'     => $this->name,
            'phone'    => $this->phone,
            'email'    => $this->email,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.index');
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
