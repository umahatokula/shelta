<?php

namespace App\Http\Livewire\PropertyPrices;

use Livewire\Component;
use App\Models\PropertyPrice;

class EditPrice extends Component
{
    public $price;
    public $propertyPrice;

    public $rules = [
        'price' => 'required',
    ];

    public $messages = [
        'price.required' => 'This field is required',
    ];

    public function mount(PropertyPrice $propertyPrice) {
      $this->propertyPrice = $propertyPrice;
      $this->price = $propertyPrice->price;
    }

    public function save()
    {
        $this->validate();

        $propertyPrice = PropertyPrice::updateOrCreate(
            [
                'id' =>  $this->propertyPrice->id
            ],
            [
                'price' => $this->price,
                'is_active' => 1
            ]
        );

        // session()->flash('message', 'Payment Plan successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property Price successfully added.']);

        redirect()->route('property-prices.index');

    }

    public function render()
    {
        return view('livewire.property-prices.edit-price');
    }
}
