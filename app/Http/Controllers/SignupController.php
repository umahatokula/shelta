<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Http\Request;

class SignupController extends Controller
{

    public function signup() {

        $data['estates'] = Estate::all();

        return view('signup.signupform', $data);
    }
}
