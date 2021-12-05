<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;
use App\Models\Property;

class Show extends Component
{
    public Property $property;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(Property $property) {
        $this->property = $property->load(['estatePropertyType.propertyType', 'estatePropertyType.estate']);
    }

    public function render()
    {
        return view('livewire.properties.show');
    }
}
