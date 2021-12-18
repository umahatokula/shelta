<?php

namespace App\Http\Livewire\Clients;

use PDF;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\Transaction;
use App\Models\OnlinePayment;
use App\Mail\PaymentMadeMailable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentMadeNotification;

class Show extends Component
{
    public Client $client;
    public $showOnlinePaymentForm = false;
    public $payingName, $payingEmail, $payingAmount;
    public $propertybalance = 0;

    protected $listeners = ['onlinePaymentSuccessful'];

    public function onSelectProperty(Property $property) {
        $price = $property->estatePropertyType ? $property->estatePropertyType->price : null;
        $this->propertybalance = $price - $property->totalPaid();
    }

    public function onlinePaymentSuccessful(Array $data) {
        // dd($data);
 
        $transaction = null;
        DB::transaction(function () use($data, &$transaction) {
            if ($data['status'] === 'success') {
                $transaction = Transaction::create([
                    'client_id'          => $data['client_id'],
                    'property_id'        => $data['property_id'],
                    'amount'             => $data['amount'],
                    'type'               => 'online',
                    'transaction_number' => $data['reference'],
                    'date'               => Carbon::now(),
                    'recorded_by'        => auth()->id(),
                    'status'             => 1,
                    'is_approved'        => 1,
                ]);
    
                if (Transaction::where('id', $transaction->id)->get()->count() === 1) {
                    Property::where('id', $transaction->property_id)->update([
                        'date_of_first_payment' => Carbon::now(),
                   ]);
                }
            }
    
            OnlinePayment::create([
                'client_id'      => $data['client_id'],
                'transaction_id' => $transaction ? $transaction->id : null,
                'message'        => $data['message'],
                'reference'      => $data['reference'],
                'status'         => $data['status'],
                'amount'         => $data['amount'],
            ]);
        });

        // log this transaction
        activity()
            ->by(auth()->user())
            ->on($transaction)
            ->withProperties(['is_staff' => false])
            ->log('online payment');

        // dispatch event
        PaymentMade::dispatch($transaction);

        // session()->flash('message', 'Payment successful.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment successful']);

        redirect()->route('clients.show', $this->client->slug);
        
    }

    public function mount(Client $client) {
        

        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'transactions.recordedBy', 
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

    public function showToastr() {
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'It works']);
    }

    public function render()
    {
        return view('livewire.clients.show');
    }
}
