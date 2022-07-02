<?php

namespace App\Http\Livewire\Signup;

use App\Events\FirstPaymentMade;
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
        $residential_address,
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
        $signature,

        $payment_mode;

    public $maritalStatuses, $countries, $states, $lgas, $estates;

    public $pageOne, $pageTwo, $pageThree;

    public $property, $client,$propertyTypes = [], $paymentPlans = [], $allPaymentPlans;
    public $estateId, $propertyTypeId, $paymentPlanId, $propertyPrice, $processingFee, $estate, $propertyType, $paymentPlan;

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
        'profile_picture'   => 'required|image|max:1024',

        'nok_name' => 'required',
        'nok_dob' => 'required',
        'nok_gender_id' => 'required',
        'relationship_with_nok' => 'required',
        'nok_address' => 'required',

//        'number_of_plots' => 'required',
//        'referrer' => 'required',
        'estate_id' => 'required',
        'propertyType_id' => 'required',
        'payment_plan_id' => 'required',
        'signature' => 'required|image|max:1024',
    ];

    protected $messages = [
        'sname.required'             => 'This field is required',
        'sname.string'             => 'This field must contain only alphabets',
        'sname.min'             => 'This name is too short',
        'onames.required'            => 'This field is required',
        'onames.string'            => 'This field must contain only alphabets',
        'onames.min'            => 'This name is too short',
        'gender.required'            => 'This field is required',
        'email.required'             => 'This field is required',
        'phone.required'             => 'This field is required',
        'marital_status_id.required' => 'This field is required',
        'dob.required'               => 'This field is required',
        'country_code.required'      => 'This field is required',
        'place_of_birth.required'    => 'This field is required',
        'state_id.required'          => 'This field is required',
        'lga_id.required'            => 'This field is required',
//        'profile_picture'   => 'required|image|max:1024',

        'nok_name.required' => 'This field is required',
        'nok_dob.required' => 'This field is required',
        'nok_gender_id.required' => 'This field is required',
        'relationship_with_nok.required' => 'This field is required',
        'nok_address.required' => 'This field is required',

//        'number_of_plots' => 'required',
//        'referrer' => 'required',
        'estate_id.required' => 'This field is required',
        'propertyType_id.required' => 'This field is required',
        'payment_plan_id.required' => 'This field is required',
//        'signature' => 'required|image|max:1024',
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

        $this->processingFee = 10_000;
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
    public function validateInput() {

        $this->validate();

        $properties = $this->getProperty();

        if ($properties->isEmpty()) {

            $this->addError('payment_type', 'No available property for the selected estate and property type');
            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'No available property for the selected estate and property type']);
            return;

        }

        // save client data
        $this->createClientProfile();

        // input validated: fire event to browser
        $this->dispatchBrowserEvent('inputValidated');
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

        // get payment plans that have been attached to this Estate-Property Type Relationship
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

        $this->paymentPlans = [];
        foreach (Arr::flatten($estatePropertyTypeIDs) as $paymentPlan) {
            $this->paymentPlans[] = $paymentPlan->toArray();
        }
    }


    public function onSelectPaymentPlan() {

        // get available property
        $properties = $this->getProperty();

        if ($properties->isEmpty()) {

            $this->addError('payment_plan_id', 'No available property. Try another estate, property type or payment plan.');
            return;
        }

        $this->property = $properties->first();
        $this->property->payment_plan_id = $this->payment_plan_id;
//        $this->property->save();

        // get monthly price based on selected payment plan
        $this->propertyPrice = $this->property->getMonthlyPaymentAmount();

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

        $client = Client::where('email', $this->email)->first();
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client;
        }

        $this->client->sname                    = $this->sname;
        $this->client->onames                   = $this->onames;
        $this->client->gender                   = $this->gender;
        $this->client->email                    = $this->email;
        $this->client->phone                    = $this->phone;
        $this->client->marital_status_id        = $this->marital_status_id;
        $this->client->dob                      = $this->dob;
        $this->client->country_code             = $this->country_code;
        $this->client->place_of_birth           = $this->place_of_birth;
        $this->client->state_id                 = $this->state_id;
        $this->client->lga_id                   = $this->lga_id;
        $this->client->residential_address      = $this->residential_address;
        $this->client->nok_name                 = $this->nok_name;
        $this->client->nok_dob                  = $this->nok_dob;
        $this->client->nok_gender_id            = $this->nok_gender_id;
        $this->client->relationship_with_nok    = $this->relationship_with_nok;
        $this->client->nok_address              = $this->nok_address;
        $this->client->nok_city                 = $this->nok_city;
        $this->client->nok_state_id             = $this->nok_state_id;
        $this->client->nok_phone                = $this->nok_phone;
        $this->client->nok_email                = $this->nok_email;
        $this->client->referrer                 = $this->referrer;
        $this->client->by_online_subscription   = true;
        $this->client->save();


        if($this->profile_picture) {

            $filePath = $this->profile_picture->store('profile_pictures', 'public');

            $this->client->profile_image_path   = $filePath;
            $this->client->save();

        }


        if($this->signature) {

            $filePath = $this->signature->store('signatures', 'public');

            $this->client->signature_path   = $filePath;
            $this->client->save();

        }

//        session()->flash('message', 'Client saved.');

//        redirect()->route('property-types.index');
    }

    /**
     * onlinePaymentSuccessful
     *
     * @param  mixed $data
     * @return void
     */
    public function onlinePaymentSuccessful(Array $data) {

        // record transaction
        $this->recordTransaction($data);

        // add plots/properties to clients
        $this->updateClientProperties();

        // show notification
        session()->flash('success', 'Congrats. Your payment was successful. Please check your email.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Successful']);

        redirect()->route('signUp');

    }

    public function recordTransaction($data) {

        if (!$this->property) {
            return ;
        }

        // verify transaction
        $verifiedTransactionResponse = Transaction::verifyPaystackTransaction($data['reference']);

        $transaction = null;

        if ($verifiedTransactionResponse['status']) {
            $verifiedTransactionData = $verifiedTransactionResponse['data'];

            DB::transaction(function() use ($data, &$transaction, $verifiedTransactionData) {

                    $amount = $data['amount'] - $this->processingFee; // total paid less processing fee

                    $transaction = Transaction::create([
                        'client_id'          => $this->client->id,
                        'property_id'        => $this->property->id,
                        'amount'             => $amount,
                        'type'               => 'online',
                        'transaction_number' => $verifiedTransactionData['reference'],
                        'date'               => Carbon::now(),
                        'instalment_date'    => Carbon::now(),
                        'recorded_by'        => auth()->id(),
                        'status'             => 1,
                        'is_approved'        => 1,
                    ]);

            });

            OnlinePayment::create([
                'client_id'         => $this->client->id,
                'transaction_id'    => $transaction ? $transaction->id : null,
                'message'           => $verifiedTransactionData['message'],
                'reference'         => $verifiedTransactionData['reference'],
                'status'            => $verifiedTransactionData['status'],
                'amount'            => $verifiedTransactionData['amount'],
                'gateway_response'  => $verifiedTransactionData['gateway_response'],
                'channel'           => $verifiedTransactionData['channel'],
                'currency'          => $verifiedTransactionData['currency'],
                'ip_address'        => $verifiedTransactionData['ip_address'],
                'fees'              => $verifiedTransactionData['fees'],
            ]);
        }

        // set date of first transaction
        if (!$this->property->date_of_first_payment) {

            $this->property->date_of_first_payment = Carbon::now();
            $this->property->save();

            // update first transaction instalment date
            $transaction->instalment_date = Carbon::now();
            $transaction->save();
        }

        // set new date for next payment
        $this->property = $transaction->property;
        $this->property->client_id = $this->client->id;
        $this->property->payment_plan_id = $this->payment_plan_id;
        $this->property->next_due_date = $this->property->nextPaymentDueDate();
        $this->property->save();

        // fire event
        PaymentMade::dispatch($transaction);
    }

    public function updateClientProperties() {

        Property::where('client_id', $this->client->id)->update(['client_id' => null]); // update clients existing properties

        Property::where('id', $this->property->id)->update([
            'client_id'               => $this->client->id,
            'payment_plan_id'         => $this->payment_plan_id,
        ]);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully added.']);

        ClientPropertiesUpdated::dispatch($this->client, collect($this->property)->toArray());

    }


    /**
     * @return void
     */
    public function signUpPreview() {

        $this->validate();

        $properties = $this->getProperty();

        if ($properties->isEmpty()) {

            $this->addError('email', 'No available property for the selected estate and property type');
            $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'No available property for the selected estate and property type']);
            return;

        }

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
