<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;

class ShowPropertyType extends Component
{
    public PropertyType $propertyType;
    public $estates;
    public $propertyTypeTotal = 0;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(PropertyType $propertyType) {
        $this->propertyType = $propertyType;
        $this->estates = $propertyType->estates->each( function($estate) {

            $estate->unit_price = $estate->onePropertyType($this->propertyType->id);
            $estate->number_of_units = $estate->properties->count();

            $estate->properties->each(function($property) use($estate) {
                $estate->property_transaction_total = ($estate->property_transaction_total + $property->transactionTotal());
                $this->propertyTypeTotal = $this->propertyTypeTotal + $property->transactionTotal();
            });

        });
    }

    public function render()
    {
        return view('livewire.property-types.show-property-type');
    }
}
