<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;

class Edit extends Component
{
    public $name, $phone, $email, $address, $client_id;
    public Client $client;
    public $estates;
    public $propertyTypes;
    public $clientProperties = [];
    public $properties = [];

    protected $rules = [
        'name' => 'required|string|min:6',
        'phone' => 'required|string|max:500',
        'clientProperties.*.estate_id' => 'required',
        'clientProperties.*.property_type_id' => 'required',
        'clientProperties.*.unique_number' => 'required',
    ];
    
    /**
     * mount
     *
     * @param  mixed $client
     * @return void
     */
    public function mount(Client $client) {
        $this->name      = $client->name;
        $this->phone     = $client->phone;
        $this->email     = $client->email;
        $this->address   = $client->address;
        $this->client_id = $client->id;
        
        $this->clientProperties = $this->properties = $client->properties->map(function($property) {
            return [
                'estate_id' => $property->estatePropertyType->propertyType->id,
                'property_type_id' => $property->estatePropertyType->estate->id,
                'unique_number' => $property->unique_number,
            ];
        });
        $this->estates = Estate::all();
        $this->propertyTypes = PropertyType::all();
        // dd($this->clientProperties);
    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function getPropertyTypes($estateId) {

        $estate = Estate::findOrFail($estateId);
        $this->propertyTypes = $estate->propertyTypes;  

    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function getPropertyTypesPrice($propertyId) {

        dd($this->clientProperties);
        $estate = Estate::findOrFail($propertyId);
        $this->propertyTypes = $estate->propertyTypes;  

    }


    public function addProperty() {
        $this->properties[] = [
            'estate_id' => null,
            'property_type_id' => null,
            'unique_number' => null,
        ];
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
    }
 
    public function save()
    {
        $this->validate();
 
        $client = Client::findOrFail($this->client_id);
        $client->name    = $this->name;
        $client->phone   = $this->phone;
        $client->email   = $this->email;
        $client->address = $this->address;
        $client->save();

        Property::where('client_id', $client->id)->delete(); // delete clients existing properties

        foreach ($this->clientProperties as $key => $clientProperty) {

            $estatePropertyType = EstatePropertyType::where([
                'estate_id'        => $clientProperty['estate_id'],
                'property_type_id' => $clientProperty['property_type_id'],
            ])->first();

            Property::create([
                'estate_property_type_id' => $estatePropertyType->id,
                'unique_number'           => $clientProperty['unique_number'],
                'client_id'               => $client->id,
            ]);
        }

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.show', $client);
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
