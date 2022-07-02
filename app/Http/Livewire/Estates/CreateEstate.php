<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use App\Models\PropertyType;
use App\Models\PropertyPrice;
use App\Models\PaymentPlan;
use App\Models\EstatePropertyType;
use App\Models\EstatePropertyTypePrice;

class CreateEstate extends Component
{
    public $propertyTypes;
    public $paymentPlans;
    public $propertyPrices;
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

    protected $messages = [
        'addedProperties.*.property_id.distinct' => 'Duplicate property type entries',
    ];

    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        $this->propertyTypes = PropertyType::all();

        $this->paymentPlans = array_combine(PaymentPlan::pluck('id')->toArray(), PaymentPlan::pluck('name')->toArray());
        $this->propertyPrices = array_combine(PropertyPrice::pluck('id')->toArray(), PropertyPrice::pluck('price')->toArray());

        $this->properties[] = [
            'property' => $this->propertyTypes,
            'number_of_units' => '',
        ];
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

            $estatePropertyType = new EstatePropertyType;
            $estatePropertyType->estate_id = $estate->id;
            $estatePropertyType->property_type_id = $property['property_id'];
            $estatePropertyType->number_of_units = $property['number_of_units'];
            $estatePropertyType->save();
            // dd($estatePropertyType);

            if (isset($property['prices'])) {
              foreach ($property['prices'] as $value) {
                EstatePropertyTypePrice::create([
                  'estate_property_type_id' => $estatePropertyType->id,
                  'payment_plan_id' => $value['plan_id'],
                  'property_price_id' => $value['price_id'],
                ]);
              }
            }
        }

        // session()->flash('message', 'Estate successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Estate successfully added.']);

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
        return view('livewire.estates.create-estate');
    }
}
