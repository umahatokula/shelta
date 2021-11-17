<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index() {        
        return view('admin.transactions.transactions-index');
    }


    /**
     * index
     *
     * @return void
     */
    public function show(Transaction $transaction) {        
        return view('admin.transactions.transactions-show', compact('transaction'));
    }

    
    /**
     * index
     *
     * @return void
     */
    public function create(Client $client) {

        $data['client'] = $client;

        return view('admin.transactions.transactions-create', $data);
    }

}
