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
use Illuminate\Support\Arr;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;
use PragmaRX\Countries\Package\Countries;

class Edit extends Component
{
    public Client $client;

    public $sname,
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
    public $states;

    public $paymentPlans;
    public $propertyTypes;
    public $propertyType_id;
    public $estates;
    public $estate_id;
    public $properties;
    public $estatePropertyType;

    public $allPropertyTypes;
    public $allProperties;
    public $allPaymentPlans;

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
        'email.unique' => 'This email has been used by another user',
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

        $this->allPropertyTypes = PropertyType::all()->toArray();  // get all property types once on mount of component to reduce DB calls
        $this->allProperties    = Property::all();                 // get all properties once on mount of component to reduce DB calls
        $this->allPaymentPlans  = PaymentPlan::all();

        $this->clientProperties = $this->clientSubscribedProperties = $client->properties->map(function($property, $key) {

            $property_type_id = null;
            $estate_id = null;

            if($property->estatePropertyType) {
                $property_type_id = $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->id : null;
                $estate_id = $property->estatePropertyType->estate ? $property->estatePropertyType->estate->id : null;
            }

            // this ensures the property types array matches the number of properties
            $this->propertyTypes[] = $this->allPropertyTypes;
            $this->paymentPlans[$key] = [];
            $this->getPaymentPlans($key, $estate_id, $property_type_id);

            $this->properties[] = $this->getUnallocatedAndClientAllocatedProperties($estate_id, $property_type_id);

            return [
                'property_type_id' => $property_type_id,
                'estate_id' => $estate_id,
                'property_id' => $property->id,
                'payment_plan_id' => $property->payment_plan_id,
            ];

        })->toArray();

        $this->staffs = Staff::all();
        $this->genders = Gender::all();
        $this->states = State::all();
        $this->estates = Estate::all();
        $this->countries = Countries::all()->pluck('name.common', 'adm0_a3')->toArray();

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

        $this->getPaymentPlans($key, $estateId, $this->propertyType_id);
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

        // get payment plans that have been attached to this Estate-ProertyType Relationship
        $this->getPaymentPlans($key, $this->estate_id, $this->propertyType_id);
    }

    /**
     * Get Payment Plans for the selected estate and property type
     *
     * @param  mixed $key
     * @param  mixed $estate_id
     * @param  mixed $propertyType_id
     * @return void
     */
    public function getPaymentPlans($key, $estate_id, $propertyType_id) {
        if (!$estate_id || !$propertyType_id) {
            return;
        }
        array_key_exists($key, $this->paymentPlans) ? array_splice($this->paymentPlans, $key, 1) : null; // remove existing payment plan at $key

        $estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate_id,
            'property_type_id' => $propertyType_id,
        ])->first();

        $estatePropertyTypePrices = $estatePropertyType ? $estatePropertyType->estatePropertyTypePrices : collect([]);

        $estatePropertyTypeIDs = $estatePropertyTypePrices->map(function($estatePropertyTypePrice) {
            return $this->allPaymentPlans->where('id', $estatePropertyTypePrice->payment_plan_id);
        });

        foreach (Arr::flatten($estatePropertyTypeIDs) as $paymentPlan) {
            $this->paymentPlans[$key][] = $paymentPlan->toArray();
        }
    }

    /**
     * addProperty
     *
     * @return void
     */
    public function addProperty() {
        $this->clientSubscribedProperties[] = [
            'estate_id' => null,
            'property_type_id' => null,
            'property_id' => null,
            'payment_plan_id' => null,
        ];

        // add empty property types array
        $this->propertyTypes[] = [];
        $this->paymentPlans[] = [];
    }

    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeProperty($key) {
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

        $unallocated = $this->allProperties->where('client_id', null); // get unallocated properties
        $allocatedToClient = $this->allProperties->where('client_id', $this->client->id); // get properties allocated to client

        return $unallocated->merge($allocatedToClient)->where('estate_property_type_id', $this->estatePropertyType->id)->toArray();
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

        Property::where('client_id', $this->client->id)->update(['client_id' => null]); // update clients existing properties

        foreach ($this->clientProperties as $key => $clientProperty) {

            $updated = Property::where('id', $clientProperty['property_id'])->update([
                'client_id'               => $this->client->id,
                'payment_plan_id'         => $clientProperty['payment_plan_id'],
            ]);

        }

        // create user account
        $user = $client->user;
        if($user) {

            $user->name = $client->sname.' '.$client->onames;
            $user->email = $client->email;

        } else {

            // $password = $event->client->generatePassword();
            $password = '12345678';
            $user = User::create(
                [
                    'name'      => $client->sname.' '.$client->onames,
                    'client_id' => $client->id,
                    'email'     => $client->email,
                    'password'  => \Hash::make($password),
                ]
            );
        }


        // assign role
        $user->assignRole('client');

        // session()->flash('message', 'Client successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully edited.']);

        redirect()->route('clients.show', $client);
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
