<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    
    use WithPagination;

    protected $listeners = ['affirmationAction' => 'destroy'];
    
    public function destroy($id) {
        Client::findOrFail($id)->delete();
        session()->flash('message', 'Client deleted.');
    }
    
    public function render()
    {
        return view('livewire.clients.index', [
            'clients' => Client::paginate(20)
        ]);
    }
}
