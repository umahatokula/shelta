<?php

namespace App\Http\Livewire\Users;

use DB;
use App\Models\User;
use App\Models\Staff;
use App\Models\Client;
use Livewire\Component;

class ListUsers extends Component
{

    public function destroy($id) {
        DB::transaction(function () use($id) {

            $user = User::findOrFail($id);

            if($user->staff_id) {    
                Staff::findOrFail($user->staff_id)->delete();
                $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Staff deleted.']);
            }

            if($user->client_id) {    
                Client::findOrFail($user->client_id)->delete();
                $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client deleted.']);
            }

            $user->delete();

        });

        // session()->flash('message', 'Client deleted.');
    }

    public function render()
    {
        return view('livewire.users.list-users', [
            'users' => User::paginate(10)
        ]);
    }
}
