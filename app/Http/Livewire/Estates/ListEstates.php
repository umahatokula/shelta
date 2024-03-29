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

    public function render()
    {
        return view('livewire.estates.list-estates', [
            'estates' => Estate::with('estatePropertyType')->paginate(10)
        ]);
    }

    public function destroy($id) {

        Estate::findOrFail($id)->delete();

        $estatePropertyTypes = EstatePropertyType::where('estate_id', $id)->each(function($estatePropertyType) {
            // $estatePropertyType->properties()->delete();
            Property::where('estate_property_type_id', $estatePropertyType->id)->update([
                'estate_property_type_id ' => null,
            ]);
        });
        
        EstatePropertyType::where('estate_id', $id)->delete();

        session()->flash('message', 'Estate deleted.');
    }
}
