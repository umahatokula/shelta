<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Events\PaymentMade;

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


    /**
     * index
     *
     * @return void
     */
    public function process(Transaction $transaction) {  
        // dd($transaction);
        return view('admin.transactions.process', compact('transaction'));
    }

    public function processStore(Request $request) {
        // dd($request->all());

        $transaction = Transaction::findOrFail($request->transaction_id);
        $transaction->status = $request->status;
        $transaction->is_approved = $request->status == 1 ? 1 : 0;
        $transaction->processed_by = auth()->id();
        $transaction->save();

        // dispatch event
        PaymentMade::dispatch($transaction);

        return redirect()->back();
    }


    // =========================CLIENT TRANSACTIONS=================================
    public function frontendRecordTransaction() {
        
        $client = Client::findOrFail(auth()->user()->client->id);
        $client = $client->load(['properties.estatePropertyType.propertyType', 'properties.estatePropertyType.estate']);

        return view('frontend.transactions.record', compact('client'));
    }

    public function frontendOnlineTransaction() {
        $data['client'] = auth()->user()->client;

        return view('frontend.transactions.online', $data);
    }

}
