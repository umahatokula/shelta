<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
    public function create(Client $client) {

        $data['client'] = $client;

        return view('admin.transactions.transactions-create', $data);
    }

}
