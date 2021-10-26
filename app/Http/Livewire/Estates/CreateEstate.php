<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use App\Models\PropertyType;

class CreateEstate extends Component
{
    public $propertyTypes;
    public $properties = [];
    public $name, $address;
    public $addedProperties = [];

    protected $rules = [
        'name' => 'required|string|min:6',
        'addedProperties.*.price' => 'regex:/^\d+(\.\d{1,2})?$/',
    ];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        $this->propertyTypes = PropertyType::all();
        array_push($this->properties, [
            'property' => $this->propertyTypes,
            'price' => ''
        ]);
    }
    
    /**
     * addProperty
     *
     * @return void
     */
    public function addProperty() {
        array_push($this->properties, [
            'property' => $this->propertyTypes,
            'price' => ''
        ]);
    }
    
    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeProperty($key) {

        if(count($this->properties) == 1) {
            session()->flash('message', 'Estate should have at least 1 property type.');
            return;
        }

        array_splice($this->properties, $key, 1);
        array_key_exists($key, $this->addedProperties) ? array_splice($this->addedProperties, $key, 1) : null;
    }

    
    /**
     * save
     *
     * @return void
     */
    public function save() {
        $this->validate();
 
        $estate = Estate::create([
            'name'    => $this->name,
            'address' => $this->address,
        ]);

        foreach($this->addedProperties as $property) {
            $estate->propertyTypes()->attach($property['property_id'], ['price' => $property['price']]);
        }

        session()->flash('message', 'Estate successfully added.');

        redirect()->route('estates.index');

    }
    
    public function render()
    {
        return view('livewire.estates.create-estate');
    }
}
