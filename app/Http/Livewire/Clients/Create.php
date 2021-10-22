<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\EstatePropertyType;

class Create extends Component
{
    public $name;
    public $phone;
    public $email;
    public $address;
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
        'name' => 'required|string|min:6',
        'phone' => 'required|string|max:500',
    ];
     
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        $this->estates = Estate::all();
        $this->propertyTypes = [];
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
    
    /**
     * save
     *
     * @return void
     */
    public function save() {
        $this->validate();
 
        $client = Client::create([
            'name'     => $this->name,
            'phone'    => $this->phone,
            'email'    => $this->email,
            'address' => $this->address,
        ]);

        // dd($this->clientProperties);
        foreach ($this->clientProperties as $key => $clientProperty) {

            $estatePropertyType = EstatePropertyType::where([
                'estate_id' => $clientProperty['estate_id'],
                'property_type_id' => $clientProperty['property_type_id'],
            ])->first();

            Property::create([
                'estate_property_type_id' => $estatePropertyType->id,
                'unique_number' => $clientProperty['unique_number'],
                'client_id' => $client->id,
            ]);
        }

        session()->flash('message', 'Client successfully added.');

        redirect()->route('clients.index');
    }
    
    public function render()
    {
        return view('livewire.clients.create');
    }
}
