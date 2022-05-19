<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUp\StoreSignUpRequest;
use App\Models\Client;
use App\Models\Estate;
use App\Models\EstatePropertyType;
use App\Models\Gender;
use App\Models\LGA;
use App\Models\MaritalStatus;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SignupController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function signup() {

        $data['estates'] = Estate::all();
        $data['maritalStatuses'] = MaritalStatus::all();
        $data['countries'] = collect(countries())->map(function($value, $index) {
            return [$value['name']];
        });
//        dd($data['countries']);
        $data['genders'] = Gender::all();
        $data['states'] = State::all();
        $data['lgas'] = LGA::all();
        $data['estates'] = Estate::all();
        $data['allPaymentPlans'] = PaymentPlan::all();
        $data['propertyTypes'] = collect([]);
        $data['paymentPlans'] = collect([]);

        return view('signup.signupform', $data);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function fetchPropertyType(Request $request) {

        if (empty($request->estate_id)) {
            return $data['propertyTypes'] = [];
        }

        $this->estate_id = $request->estate_id;

        // get property types for this estate
        $data['property_types'] = Estate::findOrFail($request->estate_id)->propertyTypes->toArray();

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function fetchPaymentPlan(Request $request) {

        if (empty($request->propertyType_id)) {
            return $data['payment_plans'] = [];
        }

        // get payment plans that have been attached to this Estate-ProertyType Relationship
        $data['payment_plans'] = $this->getPaymentPlans($request->estate_id, $request->propertyType_id);

        return response()->json($data);

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
//        dd($estate_id, $propertyType_id);

        if (!$estate_id || !$propertyType_id) {
            return;
        }

        $estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate_id,
            'property_type_id' => $propertyType_id,
        ])->first();

        $estatePropertyTypePrices = $estatePropertyType ? $estatePropertyType->estatePropertyTypePrices : collect([]);

        $estatePropertyTypeIDs = $estatePropertyTypePrices->map(function($estatePropertyTypePrice) {
            return PaymentPlan::where('id', $estatePropertyTypePrice->payment_plan_id)->first();
        });

        $paymentPlans = [];
        foreach (Arr::flatten($estatePropertyTypeIDs) as $paymentPlan) {
            $paymentPlans[] = $paymentPlan->toArray();
        }

        return $paymentPlans;
    }


    /**
     * @param StoreSignUpRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signUpPost(StoreSignUpRequest $request) {

//        dd($request->all());

        $validated = $request->validated();

        $client = new Client;
        $client->sname                 = $request->sname;
        $client->onames                = $request->onames;
        $client->gender                = $request->gender;
        $client->email                 = $request->email;
        $client->phone                 = $request->phone;
        $client->marital_status_id     = $request->marital_status_id;
        $client->dob                   = $request->dob;
        $client->country_code          = $request->country_code;
        $client->place_of_birth        = $request->place_of_birth;
        $client->state_id              = $request->state_id;
        $client->lga_id                = $request->lga_id;
        $client->nok_name              = $request->nok_name;
        $client->nok_dob               = $request->nok_dob;
        $client->nok_gender_id         = $request->nok_gender_id;
        $client->relationship_with_nok = $request->relationship_with_nok;
        $client->nok_address           = $request->nok_address;
        $client->referrer              = $request->referrer;
        $client->save();
        dd($client);

        return view('signup.signupform', $data);
    }

    public function preview(Client $client, $estate, $propertyType, $paymentPlan) {

        $data['client'] = $client;
        $data['estate'] = $estate;
        $data['propertyType'] = $propertyType;
        $data['paymentPlan'] = $paymentPlan;

        return view('signup.signuppreview', $data);
    }
}
