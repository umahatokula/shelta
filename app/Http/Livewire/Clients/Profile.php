<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Profile extends Component
{
    public $sname;
    public $onames;
    public $phone;
    public $email;

    public Client $client;

    public function mount(Client $client) {

        $this->client = $client;

        $this->sname = $client->sname;
        $this->onames = $client->onames;
        $this->phone = $client->phone;
        $this->email = $client->email;
    }

    public function save(Client $client) {


        $client->sname = $this->sname;
        $client->onames = $this->onames;
        $client->phone = $this->phone;
        $client->email = $this->email;
        $client->save();

        session()->flash('message', 'Updae successfully');

        redirect()->back();
    }

    public function render()
    {
        return view('livewire.clients.profile');
    }
}
