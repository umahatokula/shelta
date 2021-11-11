<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;

class AddProperty extends Component
{
    public Client $client;
    public $paymentPlans;
    public $estates;
    public $propertyTypes;
    public $clientProperties = [];
    public $properties = [
        [
            'estate_id' => null,
            'property_type_id' => null,
            'unique_number' => null,
        ]
    ];

    protected $rules = [
        'clientProperties' => 'array',
        'clientProperties.*.estate_id' => 'required',
        'clientProperties.*.property_type_id' => 'required',
        'clientProperties.*.unique_number' => 'required',
        'clientProperties.*.payment_plan_id' => 'required',
    ];

    protected $messages = [
        'sname.required' => 'This field is required',
        'onames.required' => 'This field is required',
        'phone.required' => 'This field is required',
    ];
    
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(Client $client) {
        $this->client = $client;
        $this->paymentPlans = PaymentPlan::all();
        $this->estates = Estate::all();
        $this->propertyTypes[] = PropertyType::all()->toArray();
        // dd($this->propertyTypes);

        $this->clientProperties = $this->properties = $client->properties->map(function($property) {

            $property_type_id = null;
            $estate_id = null;
            
            if($property->estatePropertyType) {
                $property_type_id = $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->id : null;
            }

            if($property->estatePropertyType) {
                $estate_id = $property->estatePropertyType->estate ? $property->estatePropertyType->estate->id : null;
            }

            return [
                'property_type_id' => $property_type_id,
                'estate_id' => $estate_id,
                'unique_number' => $property->unique_number,
                'payment_plan_id' => $property->payment_plan_id,
            ];
        })->toArray();
    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function getPropertyTypes($estateId, $key) {

        if (empty($estateId)) {
            return $this->propertyTypes = [];
        }

        // add property types to array
        $this->propertyTypes[$key] = Estate::findOrFail($estateId)->propertyTypes->toArray();
        // dd($estateId, $key, $this->propertyTypes);

    }

    public function addProperty() {
        $this->properties[] = [
            'estate_id' => null,
            'property_type_id' => null,
            'unique_number' => null,
            'payment_plan_id' => null,
        ];
        
        // add property types to array
        $this->propertyTypes[] = PropertyType::all()->toArray();
    }
    
    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeProperty($key) {
        array_splice($this->properties, $key, 1);
        array_key_exists($key, $this->clientProperties) ? array_splice($this->clientProperties, $key, 1) : null;
        
        // remove property types from array
        array_splice($this->propertyTypes, $key, 1);
    }
 
    public function save()
    {
        $this->validate();
 

        Property::where('client_id', $this->client->id)->delete(); // delete clients existing properties

        foreach ($this->clientProperties as $key => $clientProperty) {

            $estatePropertyType = EstatePropertyType::where([
                'estate_id'        => $clientProperty['estate_id'],
                'property_type_id' => $clientProperty['property_type_id'],
            ])->first();

            Property::create([
                'estate_property_type_id' => $estatePropertyType->id,
                'unique_number'           => $clientProperty['unique_number'],
                'client_id'               => $this->client->id,
                'payment_plan_id'         => $clientProperty['payment_plan_id'],
            ]);
        }

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.show', $this->client);
    }

    public function render()
    {
        return view('livewire.clients.add-property');
    }
}