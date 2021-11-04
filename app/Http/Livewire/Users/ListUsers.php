<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class ListUsers extends Component
{
    public function render()
    {
        return view('livewire.users.list-users', [
            'users' => User::paginate(10)
        ]);
    }
}
