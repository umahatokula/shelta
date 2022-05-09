<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Estate;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class SignupController extends Controller
{

    public function signup() {

        $data['estates'] = Estate::all();

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
