<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use App\Models\Client;
use Livewire\Component;

class TwoFactorAuth extends Component
{
    public $enable;

    public function mount() {
        $this->enable = auth()->user()->use_2fa;
    }

    public function toggle2FA() {
        dd('sdsdsd');
        $user = User::findOrFail(auth()->user()->client->id);

        if ($user) {
            $user->use_2fa = !$this->enable;
            $user->save();
        }
    }

    public function render()
    {
        return view('livewire.clients.two-factor-auth');
    }
}
