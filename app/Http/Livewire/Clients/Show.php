<?php

namespace App\Http\Livewire\Clients;

use PDF;
use App\Models\Client;
use Livewire\Component;
use App\Models\Transaction;

class Show extends Component
{
    public Client $client;

    public function mount(Client $client) {
        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
    }

    public function downloadReciept($clientId, $transactionId) {

        $data['client'] = Client::where('id', $clientId)->first();
        $data['transaction'] = Transaction::where('id', $transactionId)->first();

        $pdfContent = PDF::loadView('pdf.reciept', $data)->output();
        
        return response()->streamDownload(
            fn () => print($pdfContent),
            "filename.pdf"
        );

    }

    public function render()
    {
        return view('livewire.clients.show');
    }
}
