<?php

namespace App\Http\Livewire\PaymentPlans;

use Livewire\Component;
use App\Models\PaymentPlan;

class Plans extends Component
{
    public $plans;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        $this->plans = PaymentPlan::all();
    }

    
    public function render()
    {
        return view('livewire.payment-plans.plans');
    }
}
