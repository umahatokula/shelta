<?php

namespace App\Http\Livewire\Properties;

use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\EstatePropertyType;

class CreateProperty extends Component
{
    public $unique_number;
    public $estates;
    public $estate_id;
    public $property_type_id;
    public $propertyTypes = [];
    public $estatePropertyType;

    protected $rules = [
        'unique_number' => 'required|unique:properties',
        'estate_id' => 'required',
        'property_type_id' => 'required',
    ];

    protected $messages = [
        'unique_number.required' => 'Please enter the Property Number',
        'unique_number.unique' => 'This property number has already been used',
        'estate_id.required' => 'Please select an estate',
        'property_type_id.required' => 'Please select a  Property Type',
    ];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        $this->estates = Estate::all();
    }
     
    /**
     * updated
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
        $this->validate();

        $property = Property::create([
            'unique_number' => $this->unique_number,
            'estate_property_type_id' => $this->estatePropertyType->id,
        ]);

        // session()->flash('message', 'Property added successfully');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property added successfully']);

        redirect()->route('properties.index');
    }
    
    public function render()
    {
        return view('livewire.properties.create-property');
    }
}
