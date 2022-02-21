<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use App\Models\PropertyPrice;
use App\Models\EstatePropertyType;
use App\Models\EstatePropertyTypePrice;

class EditEstate extends Component
{
    public Estate $estate;
    public $propertyTypes;
    public $properties = [];
    public $name, $address;
    public $addedProperties = [];

    protected $listeners = ['propertyPriceAdded'];

    protected $rules = [
        'name' => 'required|string|min:2',
        'addedProperties.*.price' => 'regex:/^\d+(\.\d{1,2})?$/',
        'addedProperties.*.number_of_units' => 'numeric',
        'addedProperties.*.property_id' => 'distinct',
    ];

    /**
     * mount
     *
     * @return void
     */
    public function mount(Estate $estate) {

        $this->propertyTypes = PropertyType::all();

        $this->paymentPlans = array_combine(PaymentPlan::pluck('id')->toArray(), PaymentPlan::pluck('name')->toArray());
        $this->propertyPrices = array_combine(PropertyPrice::pluck('id')->toArray(), PropertyPrice::pluck('price')->toArray());

        $this->properties = $this->addedProperties = $estate->propertyTypes->map(function($property) use($estate) {

            // get payment plans and prices for property type
            $prices = [];
            $results = $property->getPaymentPlanAndPriceOfPropertType($estate->id);
            foreach ($results as $result) {
                $prices[] = [
                    'plan_id' => $result->payment_plan_id,
                    'price_id' => $result->property_price_id,
                ];
            }

            return [
                'property_id' => $property->id,
                'number_of_units' => $property->pivot->number_of_units,
                'prices' => $prices,
            ];
        })->toArray();

        $this->name =  $estate->name;
        $this->address = $estate->address;

    }

    /**
     * addProperty
     *
     * @return void
     */
    public function addProperty() {
        array_push($this->properties, [
            'property' => $this->propertyTypes,
            'number_of_units' => '',
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
            // session()->flash('message', 'Estate should have at least 1 property type.');
            $this->dispatchBrowserEvent('showToastr', ['type' => 'info', 'message' => 'Estate should have at least 1 property type.']);
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

        $estate = Estate::findOrFail($this->estate->id);
        $estate->name    = $this->name;
        $estate->address = $this->address;
        $estate->save();

        // get existing property types attached to this estate
        // $addedPropertyTypesInArrayFormat = collect($this->addedProperties)->map(function($p) {
        //     return $p['property_id'];
        // })->toArray();
        // $existingEstatePropertypes = EstatePropertyType::where('estate_id', $this->estate->id)->get();
        // $toBeRemoved = $existingEstatePropertypes->filter(function($value, $key) use($addedPropertyTypesInArrayFormat) {
        //     return in_array($value->property_type_id, $addedPropertyTypesInArrayFormat);
        // });
        // dd($toBeRemoved, $addedPropertyTypesInArrayFormat);
        

        // attach new properties
        $attachedPropertyTypes = [];
        foreach($this->addedProperties as $property) {

            $estatePropertyType = EstatePropertyType::updateOrCreate(
                [
                    'estate_id' => $estate->id,
                    'property_type_id' => $property['property_id'],
                ],
                [
                    'number_of_units' => $property['number_of_units']
                ]
            );

            if (isset($property['prices'])) {

                EstatePropertyTypePrice::where('estate_property_type_id', $estatePropertyType->id)->delete();

                foreach ($property['prices'] as $value) {
                  EstatePropertyTypePrice::create([
                    'estate_property_type_id' => $estatePropertyType->id,
                    'payment_plan_id' => $value['plan_id'],
                    'property_price_id' => $value['price_id'],
                  ]);
                }
              }

            $attachedPropertyTypes[] = $property['property_id'];
        }

        $detachedPropertyTypes = EstatePropertyType::whereNotIn('property_type_id', $attachedPropertyTypes)->where('estate_id', $estate->id)->pluck('property_type_id');
        $estate->propertyTypes()->detach($detachedPropertyTypes); // detach existing properties

        // session()->flash('message', 'Estate successfully edited.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Estate successfully edited.']);

        redirect()->route('estates.index');

    }
    
    /**
     * propertyPriceAdded
     *
     * @param  mixed $index
     * @param  mixed $prices
     * @return void
     */
    public  function propertyPriceAdded($index, $prices) {
        $this->addedProperties[$index]['prices'] = $prices;
    }

    public function render()
    {
        return view('livewire.estates.edit-estate');
    }
}
