<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use PragmaRX\Countries\Package\Countries;

class Create extends Component
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
    public $propertyTypes;
    public $propertyType_id;
    public $estates;
    public $estate_id;
    public $properties;
    public $estatePropertyType;

    public $allPropertyTypes;
    public $allProperties;    

    public $clientProperties = [];
    public $clientSubscribedProperties = [ // properties already subscribed to by client
        [
            'estate_id' => null,
            'property_type_id' => null,
            'property_id' => null,
        ]
    ];

    protected $rules = [
        'sname' => 'required|string|min:2',
        'onames' => 'required|string|min:2',
        'phone' => 'required|string|max:500',
        'email' => 'email',
        'clientProperties' => 'array',
        'clientProperties.*.estate_id' => 'required',
        'clientProperties.*.property_type_id' => 'required',
        'clientProperties.*.property_id' => 'required',
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
    public function mount() {
        $this->paymentPlans = PaymentPlan::all();
        $this->staffs = Staff::all();
        $this->genders = Gender::all();
        $this->states = State::all();
        $this->estates = Estate::all();
        $this->countries = Countries::all()->pluck('name.common', 'adm0_a3')->toArray();
        $this->allPropertyTypes = PropertyType::all()->toArray();  // get all property types once on mount of component to reduce DB calls
        $this->allProperties    = Property::all();                 // get all properties once on mount of component to reduce DB calls
        
        $this->propertyTypes[] = [];
        $this->properties[] = [];
    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function onSelectEstate($estateId, $key) {

        if (empty($estateId)) {
            return $this->propertyTypes = [];
        }

        // add property types to array
        $this->propertyTypes[$key] = Estate::findOrFail($estateId)->propertyTypes->toArray();

        $this->estate_id = $estateId;
    }
    
    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function onSelectPropertyType($propertyTypeId, $key) {

        $this->propertyType_id = $propertyTypeId;
        
        $this->properties[$key] = $this->getUnallocatedAndClientAllocatedProperties($this->clientProperties[$key]['estate_id'], $this->clientProperties[$key]['property_type_id']);
    }


    public function addProperty() {
        $this->clientSubscribedProperties[] = [
            'estate_id' => null,
            'property_type_id' => null,
            'property_id' => null,
            'payment_plan_id' => null,
        ];
        
        // add property types & properties to array
        $this->propertyTypes[] = [];
    }
    
    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeProperty($key) {
        // dd($this->propertyTypes, $this->properties, $key);
        
        array_splice($this->clientSubscribedProperties, $key, 1);
        array_key_exists($key, $this->clientProperties) ? array_splice($this->clientProperties, $key, 1) : null;
        
        // remove property types from array
        array_splice($this->propertyTypes, $key, 1);
        array_splice($this->properties, $key, 1);
    }
    
    /**
     * Merge properties not allocaated to anyone and properties allocated to client.
     *
     * @param  mixed $estate_id
     * @param  mixed $property_type_id
     * @return void
     */
    public function getUnallocatedAndClientAllocatedProperties($estate_id, $property_type_id) {

        // merge properties not allocaated to anyone and properties allocated to client. This helps in the case where properties are to be removed from a client. We thereofre have ot  make avvailble those properties already allocaated to him/her

        $this->estatePropertyType = EstatePropertyType::where(['estate_id' => $estate_id, 'property_type_id' => $property_type_id])->first();

        return $this->allProperties->where('client_id', null)->where('estate_property_type_id', $this->estatePropertyType->id)->toArray(); // get unallocated properties

    }
    
    /**
     * save
     *
     * @return void
     */
    public function save() {

        $this->validate();
 
        $client = new Client;
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

        Property::where('client_id', $client->id)->update(['client_id' => null]); // update clients existing properties

        foreach ($this->clientProperties as $key => $clientProperty) {

            $updated = Property::where('id', $clientProperty['property_id'])->update([
                'client_id'               => $client->id,
                'payment_plan_id'         => $clientProperty['payment_plan_id'],
            ]);

        }

        $user = User::create([
            'name'      => $client->sname.' '.$client->onames,
            'email'     => $client->email,
            'client_id' => $client->id,
            'password'  => Hash::make('12345678'),
        ]);

        // assign role
        $user->assignRole('client');

        // session()->flash('message', 'Client successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully added.']);

        redirect()->route('clients.index');
    }
    
    public function render()
    {
        return view('livewire.clients.create');
    }
}
