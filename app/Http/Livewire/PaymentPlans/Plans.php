<?php

namespace App\Http\Livewire\PaymentPlans;

use Livewire\Component;
use App\Models\PaymentPlan;
use Livewire\WithPagination;

class Plans extends Component
{
    use WithPagination;
            
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id) {
        
        PaymentPlan::findOrFail($id)->delete();

        session()->flash('message', 'Client deleted.');

    }

    public function render()
    {
        return view('livewire.payment-plans.plans', [
            'plans' => PaymentPlan::paginate(10)
        ]);
    }
}
