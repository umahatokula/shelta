<?php

namespace App\Http\Livewire\PropertyPrices;

use Livewire\Component;
use App\Models\PropertyPrice;

class CreatePrice extends Component
{

    public $price;

    public $rules = [
        'price' => 'required',
    ];

    public $messages = [
        'price.required' => 'This field is required',
    ];

    public function save()
    {
        $this->validate();

        PropertyPrice::create([
            'price' => $this->price,
            'is_active' => 1,
        ]);

        // session()->flash('message', 'Payment Plan successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property Price successfully added.']);

        redirect()->route('property-prices.index');

    }

    public function render()
    {
        return view('livewire.property-prices.create-price');
    }
}
