<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\Staff;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Events\ClientAccountCreated;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{

    public  $staff_id,
            $staff_password,
            $staff_password_confirmation,
            $client_id,
            $client_password,
            $client_password_confirmation,
            $roles,
            $role_ids;

    public function mount() {
        $this->staffs = Staff::all();
        $this->clients = Client::all();
        $this->roles = Role::all();
    }

    /**
     * saveStaff
     *
     * @return void
     */
    public function saveStaff() {

        $validatedData = $this->validate([
            'staff_id'  => 'required',
            'staff_password'  => 'required|confirmed|min:6',
            'staff_password_confirmation'  => 'required',
        ],
        [
        'staff_id.required' => 'This field is required',
        'staff_password_confirmation.required' => 'Please enter the staff password confirmation'
        ]);

        $staff = Staff::findOrFail($this->staff_id);

        $user = User::updateorCreate(
            ['email' =>  $staff->email],
            [
                'name'     => $staff->name,
                'staff_id' => $this->staff_id,
                'password' => Hash::make($this->staff_password),
            ]);

        // assign role
        $user->assignRole($this->role_ids);

        redirect()->route('users.index');
    }

    /**
     * saveClient
     *
     * @return void
     */
    public function saveClient() {

        $validatedData = $this->validate(
            [
                'client_id' => 'required',
                // 'client_password'  => 'required|confirmed|min:6',
                // 'client_password_confirmation'  => 'required',
            ],
            [
                'client_id.required' => 'This field is required',
                'client_password_confirmation.required' => 'Please enter the client password confirmation'
            ]);

        $client = Client::findOrFail($this->client_id);

        // trigger event
        ClientAccountCreated::dispatch($client);

        redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.create-user');
    }
}
