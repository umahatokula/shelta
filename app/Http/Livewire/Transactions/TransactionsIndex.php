<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;

class TransactionsIndex extends Component
{
    public function render()
    {
        return view('livewire.transactions.transactions-index');
    }
}
