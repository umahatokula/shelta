<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;
use App\Models\EstatePropertyType;

class ListEstates extends Component
{
    use WithPagination;

    public $paymentHasBeenMadeOnAtleastOneProperty = false;

    public function render()
    {
        return view('livewire.estates.list-estates', [
            'estates' => Estate::with('estatePropertyType')->paginate(10)
        ]);
    }

    public function destroy($id) {

        $estate = Estate::findOrFail($id);

        // ensure that an estate cannot be deleted if at least one property in that estate has any payment on it
        $estate->properties->map(function($property) {

            if ($property->totalPaid() > 0) {
                $this->paymentHasBeenMadeOnAtleastOneProperty = true;
            }

        });

        if ($this->paymentHasBeenMadeOnAtleastOneProperty) {
            $this->dispatchBrowserEvent('showToastr', ['type' => 'warning', 'message' => 'Unable to delete. Payment has been made on at least one property in this estate']);
            return;
        }

        $estatePropertyTypes = EstatePropertyType::where('estate_id', $id)->each(function($estatePropertyType) {
            Property::where('estate_property_type_id', $estatePropertyType->id)->update([
                'estate_property_type_id' => null,
            ]);
        });

        $estate->delete();
        EstatePropertyType::where('estate_id', $id)->delete();

        session()->flash('message', 'Estate deleted.');
    }
}
