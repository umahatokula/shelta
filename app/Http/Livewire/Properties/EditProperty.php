<?php

namespace App\Http\Livewire\Properties;

use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Validation\Rule;
use App\Models\EstatePropertyType;

class EditProperty extends Component
{
    public Property $property;
    public $unique_number;
    public $estates;
    public $estate_id;
    public $property_type_id;
    public $propertyTypes = [];
    public $estatePropertyType;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(Property $property) {
        $this->property = $property->load(['estatePropertyType.propertyType', 'estatePropertyType.estate']);

        $this->estates = Estate::all();
        $this->propertyTypes = PropertyType::all();

        $this->unique_number = $property->unique_number;
        $this->estatePropertyType = $property->estatePropertyType;
        $this->estate_id = $property->estatePropertyType->estate->id;
        $this->property_type_id = $property->estatePropertyType->propertyType->id;
    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function getPropertyTypes($estateId) {

        if (empty($estateId)) {
            return $this->propertyTypes = [];
        }

        $this->propertyTypes = Estate::findOrFail($estateId)->propertyTypes;

    }

    public function getEstatePropertyTypeBinding($propertyTypeId) {
        $this->estatePropertyType = EstatePropertyType::where(['estate_id' => $this->estate_id, 'property_type_id' => $propertyTypeId])->first();
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save() {
        
        $this->validate([
            'unique_number' => ['required', Rule::unique('properties')->ignore($this->property)],
            'estate_id' => 'required',
            'property_type_id' => 'required',
        ]);

        $property = Property::findOrFail($this->property->id)->update([
            'unique_number' => $this->unique_number,
            'estate_property_type_id' => $this->estatePropertyType->id,
        ]);

        // session()->flash('message', 'Property added successfully');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property edited successfully']);

        redirect()->route('properties.index');
    }
    
    public function render()
    {
        return view('livewire.properties.edit-property');
    }
}
