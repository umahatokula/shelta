<?php

namespace App\Http\Livewire\PaymentPlans;

use App\Models\EstatePropertyTypePrice;
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

        $estatePropertyTypePlan = EstatePropertyTypePrice::where('payment_plan_id', $id)->first();

        if ($estatePropertyTypePlan) {
            $this->dispatchBrowserEvent('showToastr', ['type' => 'warning', 'message' => 'Cannot delete price already in use.']);
            return ;
        }

        PaymentPlan::findOrFail($id)->delete();

        // delete corresponding entry in EstatePropertyTypePrice
        EstatePropertyTypePrice::where('payment_plan_id', $id)->delete();

        // session()->flash('message', 'Client deleted.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment Plan successfully deleted.']);

        redirect()->route('payment-plans.index');

    }

    public function render()
    {
        return view('livewire.payment-plans.plans', [
            'plans' => PaymentPlan::paginate(10)
        ]);
    }
}
