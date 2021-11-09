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

            $estate->number_of_units = $estate->onePropertyTypePrice($this->propertyType->id) ? $estate->onePropertyTypePrice($this->propertyType->id)->number_of_units : 0;
            $estate->unit_price = $estate->onePropertyTypePrice($this->propertyType->id) ? $estate->onePropertyTypePrice($this->propertyType->id)->price : 0;

            $estate->properties->each(function($property) use($estate) {

                if ($property->estatePropertyType->propertyType->id == $this->propertyType->id) {
                    $estate->property_transaction_total = ($estate->property_transaction_total + $property->transactionTotal());
                    $this->propertyTypeTotal = $this->propertyTypeTotal + $property->transactionTotal();
                }
                
            });

        });
    }

    public function render()
    {
        return view('livewire.property-types.show-property-type');
    }
}
