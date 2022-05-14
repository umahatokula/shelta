<?php

namespace App\Http\Livewire\PaymentPlans;

use Livewire\Component;
use App\Models\PaymentPlan;

class CreatePlan extends Component
{

    public $name;
    public $number_of_months;

    public $rules = [
        'name' => 'required',
         'number_of_months' => 'required',
    ];

    public $messages = [
        'name.required' => 'This field is required',
        'number_of_months.required' => 'This field is required',
    ];

    public function save()
    {
        $this->validate();

        PaymentPlan::create([
            'name' => $this->name,
            'number_of_months' => $this->number_of_months,
        ]);

        // session()->flash('message', 'Payment Plan successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment Plan successfully added.']);

        redirect()->route('payment-plans.index');

    }

    public function render()
    {
        return view('livewire.payment-plans.create-plan');
    }
}
