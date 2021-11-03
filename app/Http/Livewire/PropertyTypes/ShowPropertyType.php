<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;

class ShowPropertyType extends Component
{
    public PropertyType $propertyType;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(PropertyType $propertyType) {
        $this->propertyType = $propertyType->load('estates');
        dd($this->propertyType);
    }

    public function render()
    {
        return view('livewire.property-types.show-property-type');
    }
}
