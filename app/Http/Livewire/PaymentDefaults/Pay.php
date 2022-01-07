<?php

namespace App\Http\Livewire\PaymentDefaults;

use App\Models\Client;
use Livewire\Component;
use App\Models\Property;
use App\Models\PaymentDefault;

class Pay extends Component
{    
    public Property $property;
    public Client $client;
    public $amount;

    public $rules = ['amount' => 'required'];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount($unique_number, $client_id) {
        $this->property = Property::where('unique_number', $unique_number)->first();
        $this->client = Client::find($client_id);
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save() {
        
        $this->validate();

        if (!$this->property->getClientPaymentDefaultsTotal() > 0) {
            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'No payment defaults to pay']);
            return ;
        }
        // dd($this->amount);

        $paymentDefault = PaymentDefault::create([
            'client_id'   => $this->client->id,
            'property_id' => $this->property->id,
            'paid_amount' => $this->amount,
        ]);
        
        
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment successful']);

        redirect()->route('clients.show', $this->client->slug);
    }
    
    public function render()
    {
        return view('livewire.payment-defaults.pay');
    }
}
