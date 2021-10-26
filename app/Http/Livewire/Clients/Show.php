<?php

namespace App\Http\Livewire\Clients;

use PDF;
use Mail;
use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\OnlinePayment;

class Show extends Component
{
    public Client $client;
    public $showOnlinePaymentForm = false;
    public $payingName, $payingEmail, $payingAmount;

    protected $listeners = ['onlinePaymentSuccessful'];

    public function onlinePaymentSuccessful(Array $data) {
        // dd($data);

        OnlinePayment::create([
            'client_id' => $data['client_id'],
            'message'   => $data['message'],
            'reference' => $data['reference'],
            'status'    => $data['status'],
            'amount'    => $data['amount'],
        ]);
 
        if ($data['status'] === 'success') {
            $transaction = Transaction::create([
                'client_id'          => $data['client_id'],
                'property_id'        => $data['property_id'],
                'amount'             => $data['amount'],
                'type'               => 'cr',
                'transaction_number' => $data['reference'],
                'date'               => Carbon::now(),
            ]);
        }

        session()->flash('message', 'Payment successful.');

        redirect()->route('clients.show', $this->client->slug);
        
    }

    public function mount(Client $client) {
        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
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
        $data['transaction'] = Transaction::where('id', $transactionId)->first();

        $pdfContent = PDF::loadView('pdf.reciept', $data)->output();
        
        return response()->streamDownload(
            fn () => print($pdfContent),
            "filename.pdf"
        );

    }
    
    /**
     * mailReciept
     *
     * @param  mixed $clientId
     * @param  mixed $transactionId
     * @return void
     */
    public function mailReciept($clientId, $transactionId) {

        $data['client'] = Client::where('id', $clientId)->first();
        $data['transaction'] = Transaction::where('id', $transactionId)->first();

        $pdfContent = PDF::loadView('pdf.reciept', $data);

        Mail::send('emails.recieptEmail', $data, function($message)use($data, $pdfContent) {
            $message->to($data['client']->email)
                    ->subject('Payment Reciept ['.$data['client']->sname.' '.$data['client']->onames.']')
                    ->attachData($pdfContent->output(), "reciept.pdf");
        });

        session()->flash('message', 'Email sent successfully.');

        redirect()->route('clients.show', $this->client->slug);
    }

    public function render()
    {
        return view('livewire.clients.show');
    }
}
