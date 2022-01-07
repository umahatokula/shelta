<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use PDF;
use App\Models\Transaction;
use Livewire\WithPagination;
use App\Mail\PaymentMadeMailable;
use Illuminate\Support\Facades\Mail;

class ListTransactions extends Component
{
    use WithPagination; 

    protected $paginationTheme = 'bootstrap';
    
    public $search;
    
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
        
        // session()->flash('message', 'Email sent successfully.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Email sent successfully.']);
    }
    
    /**
     * destroy
     *
     * @return void
     */
    public function destroy($id) {
        Property::findOrFail($id)->delete();
        session()->flash('message', 'Property deleted.');
    }
    
    public function render()
    {
        return view('livewire.transactions.list-transactions', [
            'transactions' => Transaction::where('transaction_number', 'LIKE', '%'.$this->search.'%')->paginate(20),
        ]);
    }
}
