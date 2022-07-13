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
    public $validatedData = [];
    public $index;
    public $selectedPlan = null;
    public $selectedPrice = null;

    protected $rules = [
        'paired.*.plan_id' => 'required',
        'paired.*.price_id' => 'required',
    ];

    public function mount($index) {
        $this->reset(['index', 'paired']);

        $this->paymentPlans = PaymentPlan::all();
        $this->propertyPrices = PropertyPrice::all();
        $this->index = $index;

        $this->planPrices[] = [
            'plan_id' => '',
            'price_id' => '',
        ];
    }

    public function setPlanId($value, $key) {

        $this->selectedPlan = $value;

        if ($this->selectedPlan && $this->selectedPrice) {
            $this->checkDuplicate();
        }

    }

    public function setPriceId($value, $key) {

        $this->selectedPrice = $value;

        if ($this->selectedPlan && $this->selectedPrice) {
            $this->checkDuplicate();
        }

    }

    public function checkDuplicate() {

        foreach ($this->validatedData as $vd) {
            if ($vd['plan_id'] == $this->selectedPlan && $vd['price_id'] == $this->selectedPrice) {
//                $this->addError('duplicate_error', 'Ensure there are no duplicate selections for Payment Plan and Price');
                $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'Ensure there are no duplicate selections for Payment Plan and Price']);
                return;
            }
        }

        $this->validatedData[] = [
            'plan_id' => $this->selectedPlan,
            'price_id' => $this->selectedPrice,
        ];

        $this->selectedPlan = null;
        $this->selectedPrice = null;

    }

    public function addPrice() {
        $this->planPrices[] = [
            'plan_id' => '',
            'price_id' => '',
        ];
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

        $this->emit('propertyPriceAdded', $this->index, $this->validatedData);
        $this->emit('hideModal');

        $this->reset(['index', 'validatedData']);
    }

    public function render()
    {
        return view('livewire.estates.add-property-price-modal', [
            'estates' => Estate::with('estatePropertyType')->paginate(10)
        ]);
    }

}
