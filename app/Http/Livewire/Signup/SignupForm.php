<?php

namespace App\Http\Livewire\Signup;

use DB;
use Carbon\Carbon;
use App\Models\LGA;
use App\Models\State;
use App\Models\Client;
use App\Models\Estate;
use App\Models\Gender;
use Livewire\Component;
use App\Models\Property;
use App\Events\PaymentMade;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use App\Models\MaritalStatus;
use App\Models\OnlinePayment;
use Livewire\WithFileUploads;
use App\Models\EstatePropertyType;
use App\Events\ClientPropertiesUpdated;

class SignupForm extends Component
{
    use WithFileUploads;

    public $sname,
        $onames,
        $phone,
        $gender,
        $dob,
        $email,
        $city,
        $state_id,
        $address,
        $country_code,
        $place_of_birth,
        $lga_id,
        $marital_status_id,
        $profile_picture,

        $nok_name,
        $nok_dob,
        $nok_address,
        $nok_city,
        $nok_state_id,
        $relationship_with_nok,
        $nok_gender_id,
        $nok_phone,
        $nok_email,

        $number_of_plots,
        $estate_id,
        $propertyType_id,
        $payment_plan_id,
        $referrer,
        $signature;

    public $maritalStatuses, $countries, $states, $lgas, $estates;

    public $pageOne, $pageTwo, $pageThree;

    public $property, $client,$propertyTypes = [], $paymentPlans = [], $allPaymentPlans;

    protected $rules = [
        'sname'             => 'required|string|min:2',
        'onames'            => 'required|string|min:2',
        'gender'            => 'required',
        'email'             => 'required',
        'phone'             => 'required',
        'marital_status_id' => 'required',
        'dob'               => 'required',
        'country_code'      => 'required',
        'place_of_birth'    => 'required',
        'state_id'          => 'required',
        'lga_id'            => 'required',
        // 'profile_picture'   => 'required|image|max:1024',

        'nok_name' => 'required',
        'nok_dob' => 'required',
        'nok_gender_id' => 'required',
        'relationship_with_nok' => 'required',
        'nok_address' => 'required',

//        'number_of_plots' => 'required',
        'referrer' => 'required',
        'estate_id' => 'required',
        'propertyType_id' => 'required',
        'payment_plan_id' => 'required',
        // 'signature' => 'required|image|max:1024',
    ];

    protected $listeners = [
        'onlinePaymentSuccessful',
        'validateInput',
    ];

    public function mount() {
        $this->pageOne = true;

        $this->maritalStatuses = MaritalStatus::all();
        $this->countries = countries();
        $this->genders = Gender::all();
        $this->states = State::all();
        $this->lgas = LGA::all();
        $this->estates = Estate::all();
        $this->allPaymentPlans = PaymentPlan::all();
    }

    public function setPageOne() {
        $this->pageOne = true;
        $this->pageTwo = false;
        $this->pageThree = false;
    }

    public function setPageTwo() {
        $this->pageOne = false;
        $this->pageTwo = true;
        $this->pageThree = false;
    }

    public function setPageThree() {
        $this->pageOne = false;
        $this->pageTwo = false;
        $this->pageThree = true;
    }

    /**
     * validate Input for online payment
     *
     * @param  mixed $data
     * @return void
     */
    public function validateInput(Array $data) {

        $this->validate();

        $properties = $this->getProperty();

        if ($properties->isEmpty()) {

            $this->addError('email', 'No available property for the selected estate and property type');
            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'No available property for the selected estate and property type']);
            return;

        }

        // redirect to preview page
        $this->signUpPreview();
    }

    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function onSelectEstate($estateId) {

        if (empty($estateId)) {
            return $this->propertyTypes = [];
        }

        $this->estate_id = $estateId;

        // get property types for this estate
        $this->propertyTypes = Estate::findOrFail($estateId)->propertyTypes->toArray();

    }

    /**
     * getPropertyTypes
     *
     * @param  mixed $estateId
     * @return void
     */
    public function onSelectPropertyType($propertyTypeId) {

        $this->propertyType_id = $propertyTypeId;

        // get payment plans that have been attached to this Estate-ProertyType Relationship
        $this->getPaymentPlans($this->estate_id, $this->propertyType_id);

    }

    /**
     * Get Payment Plans for the selected estate and property type
     *
     * @param  mixed $key
     * @param  mixed $estate_id
     * @param  mixed $propertyType_id
     * @return void
     */
    public function getPaymentPlans($estate_id, $propertyType_id) {
        if (!$estate_id || !$propertyType_id) {
            return;
        }

        $estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate_id,
            'property_type_id' => $propertyType_id,
        ])->first();

        $estatePropertyTypePrices = $estatePropertyType ? $estatePropertyType->estatePropertyTypePrices : collect([]);

        $estatePropertyTypeIDs = $estatePropertyTypePrices->map(function($estatePropertyTypePrice) {
            return $this->allPaymentPlans->where('id', $estatePropertyTypePrice->payment_plan_id);
        });

        foreach (Arr::flatten($estatePropertyTypeIDs) as $paymentPlan) {
            $this->paymentPlans[] = $paymentPlan->toArray();
        }
    }

    /**
     * Get Property belonging to payment plan
     *
     * @return void
     */
    public function getProperty() {
        return (new Property)->getUnallocatedAllocatedProperties($this->estate_id, $this->propertyType_id);
    }

    /**
     * create cient Profile
     *
     * @return void
     */
    public function createClientProfile() {

        $this->client = new Client;
        $this->client->sname                 = $this->sname;
        $this->client->onames                = $this->onames;
        $this->client->gender                = $this->gender;
        $this->client->email                 = $this->email;
        $this->client->phone                 = $this->phone;
        $this->client->marital_status_id     = $this->marital_status_id;
        $this->client->dob                   = $this->dob;
        $this->client->country_code          = $this->country_code;
        $this->client->place_of_birth        = $this->place_of_birth;
        $this->client->state_id              = $this->state_id;
        $this->client->lga_id                = $this->lga_id;
        $this->client->nok_name              = $this->nok_name;
        $this->client->nok_dob               = $this->nok_dob;
        $this->client->nok_gender_id         = $this->nok_gender_id;
        $this->client->relationship_with_nok = $this->relationship_with_nok;
        $this->client->nok_address           = $this->nok_address;
        $this->client->referrer              = $this->referrer;

        $this->client->save();


        if($this->profile_picture) {
            $this->client
                ->addMedia($this->profile_picture->getRealPath())
                ->usingName($this->profile_picture->getClientOriginalName())
                ->toMediaCollection('profile_picture', 'public');

        }

        session()->flash('message', 'Property Type successfully added.');

        redirect()->route('property-types.index');
    }

    public function signUpPreview() {

        // create client profile
        $this->createClientProfile();

        // redirect to preview page
        redirect()->route('signUpPreview', [$this->client, $this->estate_id, $this->propertyType_id, $this->payment_plan_id]);
    }

    public function render()
    {
        return view('livewire.signup.signup-form');
    }
}
