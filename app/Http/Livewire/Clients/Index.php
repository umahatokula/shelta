<?php

namespace App\Http\Livewire\Clients;

use DB;
use App\Models\Client;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    protected $listeners = ['affirmationAction' => 'destroy'];

    public function destroy($id) {
        DB::transaction(function () use($id) {

            Client::findOrFail($id)->delete();

            User::where('client_id', $id)->delete();

        });

        // session()->flash('message', 'Client deleted.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client deleted.']);
    }

    public function render()
    {
        return view('livewire.clients.index', [
            'clients' => Client::paginate(20)
        ]);
    }
}
