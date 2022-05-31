<?php

namespace App\Http\Controllers;

use App\Events\FirstPaymentMade;
use App\Models\Bank;
use App\Models\Client;
use App\Events\PaymentMade;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() {

        $data['banks'] = Bank::all();
        $date_from = Carbon::now()->startOfMonth();
        $date_to = Carbon::now()->endOfMonth();
        $bank_id = null;
        $transaction_number = null;
        $status = null;

        $transactionsQuery = Transaction::query();
        $transactionsQuery = $transactionsQuery->orderBy('created_at', 'desc');

        if (request('date_from')) {
            $date_from = request('date_from');
            $date_to = request('date_to');
        }
        $transactionsQuery = $transactionsQuery->whereBetween('date', [$date_from, $date_to]);

        if (request('bank_id')) {
            $bank_id = request('bank_id');
            $transactionsQuery = $transactionsQuery->where('bank_id', request('bank_id'));
        }

        if (request('status')) {
            $status = request('status');
            // dd($status);
            $transactionsQuery = $transactionsQuery->where('status', request('status'));
        }

        if (request('transaction_number')) {
            $transaction_number  = request('transaction_number');
            $transactionsQuery = $transactionsQuery->where('transaction_number', 'LIKE', "%{$transaction_number}%");
        }

        $data['transactions'] = $transactionsQuery ->paginate(20);
        $data['transactionTotal'] = (new Transaction)->getTotal();

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $data['bank_id'] = $bank_id;
        $data['status'] = $status;
        $data['transaction_number'] = $transaction_number;
        // dd($data);

        return view('admin.transactions.transactions-index', $data);
    }

    /**
     * downloadReciept
     *
     * @param  mixed $clientId
     * @param  mixed $transactionId
     * @return void
     */
    public function downloadReciept($clientId, $transactionId) {

        $data['client'] = Client::where('id', $clientId)->first();
        $data['transaction'] = Transaction::where('id', $transactionId)->with(['property.estatePropertyType.propertyType', 'property.estatePropertyType.estate'])->first();

        $pdfContent = PDF::loadView('pdf.reciept', $data)->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "filename.pdf"
        );

    }

    /**
     * Send transsaction receipt
     *
     * @param  mixed $clientId
     * @param  mixed $transactionId
     * @return void
     */
    public function mailReciept($clientId, $transactionId) {

        $transaction = Transaction::where('id', $transactionId)->with(['property.estatePropertyType.propertyType', 'property.estatePropertyType.estate'])->first();
        Mail::to($transaction->client)->queue(new PaymentMadeMailable($transaction));

        session()->flash('message', 'Email sent successfully.');
        return redirect()->back();
    }

    /**
     * destroy
     *
     * @return void
     */
    public function destroy($id) {
        Property::findOrFail($id)->delete();
        session()->flash('message', 'Property deleted.');

        return redirect()->back();
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
    public function edit(Client $client, Transaction $transaction) {

        $data['client'] = $client;
        $data['transaction'] = $transaction;

        return view('admin.transactions.transactions-edit', $data);
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

        // set date of first transaction
        $property = $transaction->property;
        if (!$property->date_of_first_payment) {
            $property->date_of_first_payment = $transaction->date;
            $property->save();
        }

        // fire event
        if ($request->status == 1) {

            if (!$property->date_of_first_payment) {
                FirstPaymentMade::dispatch($transaction);
            } else {
                PaymentMade::dispatch($transaction);
            }

        }

        return redirect()->back();
    }


    // =========================CLIENT TRANSACTIONS=================================
    public function frontendRecordTransaction() {
        $data['client'] = auth()->user()->client;

        return view('frontend.transactions.record', $data);
    }

    public function frontendOnlineTransaction() {
        $data['client'] = auth()->user()->client;

        return view('frontend.transactions.online', $data);
    }

}
