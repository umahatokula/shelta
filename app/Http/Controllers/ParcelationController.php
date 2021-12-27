<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ParcelationController;

class ParcelationController extends Controller
{
    public function selectPlot() {
        return view('frontend.parcelation.plots');
    }
}
