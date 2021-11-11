<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;

class ShowPropertyType extends Component
{
    public PropertyType $propertyType;
    public $estates;
    public $propertyTypeTotal = 0;
    public $assignedPropertyTypes;

    /**
     * mount
     *
     * @return void
     */
    public function mount(PropertyType $propertyType) {

        $this->propertyType = $propertyType;

        $this->assignedPropertyTypes = EstatePropertyType::where(['property_type_id' => $propertyType->id])->get();
      
        $this->estates = $propertyType->estates->each( function($estate) {

            $assignedPropertyTypeToEstate = $this->assignedPropertyTypes->where('estate_id', $estate->id)->first();

            $estate->number_of_units = $assignedPropertyTypeToEstate ? $assignedPropertyTypeToEstate->number_of_units : 0;
            $estate->unit_price      = $assignedPropertyTypeToEstate ? $assignedPropertyTypeToEstate->price : 0;

            // $estate->properties->each(function($property) use($estate) {

            //     if ($property->estatePropertyType->propertyType->id == $this->propertyType->id) {
            //         $estate->property_transaction_total = ($estate->property_transaction_total + $property->transactionTotal());
            //         $this->propertyTypeTotal = $this->propertyTypeTotal + $property->transactionTotal();
            //     }

            // });

            // $estate->withSum('properties.tranactions', 'amount');

        });
    }

    public function render()
    {
        return view('livewire.property-types.show-property-type');
    }
}
