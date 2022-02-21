<?php

namespace App\Http\Livewire\Clients;

use DB;
use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Models\Transaction;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    protected $listeners = ['affirmationAction' => 'destroy'];

    public function destroy($id) {

        // get the properties IDs of this client
        $propertiesIDs  = Property::where('client_id', $id)->pluck('id')->toArray();
        // dd( $propertiesIDs);

        DB::transaction(function () use($id, $propertiesIDs) {

            Client::findOrFail($id)->delete();

            User::where('client_id', $id)->delete();

            // unassign properties belnging to this client
            Property::where('client_id', $id)->update([
                'client_id' => null,
                'payment_plan_id' => null,
            ]);

            // delete all transsactions of the clients properties
            Transaction::whereIn('property_id', $propertiesIDs)->delete();

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
