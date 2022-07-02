<?php

namespace App\Http\Livewire\SMS;

use Livewire\Component;
use Zeevx\LaraTermii\LaraTermii;

class Balance extends Component
{
    public $smsBalance;

    public function getSMSBalance() {
        $termii = new LaraTermii(env('TERMII_API_KEY'));
        $this->smsBalance = \json_decode($termii->balance())->balance;
    }

    public function render()
    {
        return view('livewire.s-m-s.balance');
    }
}
