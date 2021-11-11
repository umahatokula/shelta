<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class EstatePropertyTypeController extends Controller
{
    public function showClients(Estate $estate, PropertyType $propertyType) {
        $data['estate'] = $estate;
        $data['propertyType'] = $propertyType;

        return view('admin.estate-propert-type.show-clients', $data);
    }
}
