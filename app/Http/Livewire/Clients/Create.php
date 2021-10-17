<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $phone;
    public $email;
    public $address;

    protected $rules = [
        'name' => 'required|string|min:6',
        'phone' => 'required|string|max:500',
    ];
 
    public function save()
    {
        $this->validate();
 
        Client::create([
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
        return view('livewire.clients.create');
    }
}
