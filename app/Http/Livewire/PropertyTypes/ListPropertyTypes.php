<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithPagination;
use App\Models\EstatePropertyType;

class ListPropertyTypes extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.property-types.list-property-types', [
            'propertyTypes' => PropertyType::paginate(10),
        ]);
    }

    public function destroy($id) {

        PropertyType::findOrFail($id)->delete();
        
        $estatePropertyTypes = EstatePropertyType::where('property_type_id', $id)->each(function($estatePropertyType) {
            $estatePropertyType->properties()->delete();
        });
        
        EstatePropertyType::where('estate_id', $id)->delete();

        session()->flash('message', 'Property Type deleted.');
    }
}
