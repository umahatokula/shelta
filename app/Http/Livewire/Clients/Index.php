<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    
    use WithPagination;
    
    public function render()
    {
        return view('livewire.clients.index', [
            'clients' => Client::paginate(20)
        ]);
    }
}
