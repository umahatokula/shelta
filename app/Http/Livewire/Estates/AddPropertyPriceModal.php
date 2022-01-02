<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use App\Models\PaymentPlan;
use App\Models\PropertyPrice;

class AddPropertyPriceModal extends Component
{
    public $paymentPlans;
    public $propertyPrices;
    public $planPrices = [];
    public $paired = [];
    public $index;

    protected $rules = [
        'paired.*.plan_id' => 'required|distinct',
        'paired.*.price_id' => 'required',
    ];

    public function mount($index) {
        $this->reset(['index', 'paired']);

        $this->paymentPlans = PaymentPlan::all();
        $this->propertyPrices = PropertyPrice::all();
        $this->index = $index;

        array_push($this->planPrices, [
            'plan_id' => '',
            'price_id' => '',
        ]);
    }

    public function addPrice() {
        array_push($this->planPrices, [
            'plan_id' => '',
            'price_id' => '',
        ]);
    }

    public function removePrice($key) {

        if(count($this->planPrices) == 1) {
            // session()->flash('message', 'There should be at least one price added');
            $this->dispatchBrowserEvent('showToastr', ['type' => 'info', 'message' => 'There should be at least one price added']);
            return;
        }

        array_splice($this->planPrices, $key, 1);
        array_key_exists($key, $this->paired) ? array_splice($this->paired, $key, 1) : null;

    }

    public function attachPrice() {
        $this->validate();

        $this->emit('propertyPriceAdded', $this->index, $this->paired);
        $this->emit('hideModal');

        $this->reset(['index', 'paired']);
    }

    public function render()
    {
        return view('livewire.estates.add-property-price-modal', [
            'estates' => Estate::with('estatePropertyType')->paginate(10)
        ]);
    }

}
