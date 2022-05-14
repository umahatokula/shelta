<?php

namespace App\Http\Livewire\PaymentPlans;

use Livewire\Component;
use App\Models\PaymentPlan;

class EditPlan extends Component
{

    public $name;
    public $number_of_months;
    public PaymentPlan $paymentPlan;

    public $rules = [
        'name' => 'required',
         'number_of_months' => 'required',
    ];

    public $messages = [
        'name.required' => 'This field is required',
        'number_of_months.required' => 'This field is required',
    ];

    public function mount(PaymentPlan $paymentPlan) {
        $this->paymentPlan = $paymentPlan;
        $this->name = $paymentPlan->name;
        $this->number_of_months = $paymentPlan->number_of_months;
    }

    public function save() {

        $this->validate();

        $paymentPlan = PaymentPlan::updateOrCreate(
            [
                'id' =>  $this->paymentPlan->id
            ],
            [
                'name' => $this->name,
                'number_of_months' => $this->number_of_months,
            ]
        );

        redirect()->route('payment-plans.index');

        // session()->flash('message', 'Payment Plan successfully updated.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment Plan successfully edited.']);

    }

    public function render()
    {
        return view('livewire.payment-plans.edit-plan');
    }
}
