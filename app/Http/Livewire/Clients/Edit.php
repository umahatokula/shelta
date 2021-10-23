<?php

namespace App\Http\Livewire\Clients;

use App\Models\Staff;
use App\Models\State;
use App\Models\Client;
use App\Models\Estate;
use App\Models\Gender;
use Livewire\Component;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;
use PragmaRX\Countries\Package\Countries;

class Edit extends Component
{
    public  $sname,
            $onames,
            $phone,
            $email,
            $gender,
            $dob,
            $city,
            $state_id,
            $address,
            $nok_name,
            $nok_address,
            $nok_city,
            $nok_state_id,
            $relationship_with_nok,
            $employer_name,
            $employer_address,
            $employer_city,
            $employer_state_id,
            $employer_country_id = 'NGA',
            $employer_phone,
            $payment_plan_id,
            $agent_id,
            $countries;

    public $genders;
    public $staffs;
    public $paymentPlans;
    public $estates;
    public $states;
    public $propertyTypes;
    public $clientProperties = [];
    public $properties = [
        [
            'estate_id' => null,
            'property_type_id' => null,
            'unique_number' => null,
        ]
    ];
    public Client $client;

    protected $rules = [
        'sname' => 'required|string|min:6',
        'onames' => 'required|string|min:6',
        'phone' => 'required|string|max:500',
        'email' => 'email',
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
        $this->client_id             = $client->id;
        $this->sname                 = $client->sname;
        $this->onames                = $client->onames;
        $this->phone                 = $client->phone;
        $this->email                 = $client->email;
        $this->gender                = $client->gender;
        $this->dob                   = $client->dob;
        $this->city                  = $client->city;
        $this->state_id              = $client->state_id;
        $this->address               = $client->address;
        $this->nok_name              = $client->nok_name;
        $this->nok_address           = $client->nok_address;
        $this->nok_city              = $client->nok_city;
        $this->nok_state_id          = $client->nok_state_id;
        $this->relationship_with_nok = $client->relationship_with_nok;
        $this->employer_name         = $client->employer_name;
        $this->employer_address      = $client->employer_address;
        $this->employer_city         = $client->employer_city;
        $this->employer_state_id     = $client->employer_state_id;
        $this->employer_country_id   = $client->employer_country_id;
        $this->employer_phone        = $client->employer_phone;
        $this->payment_plan_id       = $client->payment_plan_id;
        $this->agent_id              = $client->agent_id;
        
        $this->clientProperties = $this->properties = $client->properties->map(function($property) {
            return [
                'property_type_id' => $property->estatePropertyType->propertyType->id,
                'estate_id' => $property->estatePropertyType->estate->id,
                'unique_number' => $property->unique_number,
            ];
        })->toArray();

        $this->paymentPlans = PaymentPlan::all();
        $this->staffs = Staff::all();
        $this->genders = Gender::all();
        $this->states = State::all();
        $this->estates = Estate::all();
        $this->propertyTypes = PropertyType::all();
        $this->countries = Countries::all()->pluck('name.common', 'adm0_a3')->toArray();
        // dd($this->countries);
        

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
        // dd($this->properties);
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
        $client->sname                 = $this->sname;
        $client->onames                = $this->onames;
        $client->phone                 = $this->phone;
        $client->email                 = $this->email;
        $client->gender                = $this->gender;
        $client->dob                   = $this->dob;
        $client->city                  = $this->city;
        $client->state_id              = $this->state_id;
        $client->address               = $this->address;
        $client->nok_name              = $this->nok_name;
        $client->nok_address           = $this->nok_address;
        $client->nok_city              = $this->nok_city;
        $client->nok_state_id          = $this->nok_state_id;
        $client->relationship_with_nok = $this->relationship_with_nok;
        $client->employer_name         = $this->employer_name;
        $client->employer_address      = $this->employer_address;
        $client->employer_city         = $this->employer_city;
        $client->employer_state_id     = $this->employer_state_id;
        $client->employer_country_id   = $this->employer_country_id;
        $client->employer_phone        = $this->employer_phone;
        $client->payment_plan_id       = $this->payment_plan_id;
        $client->agent_id              = $this->agent_id;
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
