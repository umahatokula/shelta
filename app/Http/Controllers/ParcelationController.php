<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\ParcelationController;

class ParcelationController extends Controller
{    
    /**
     * pay
     *
     * @return void
     */
    public function pay($plot_unique_number) {
        $data['property'] = Property::where('unique_number', $plot_unique_number)->first();
        
        return view('frontend.parcelation.pay', $data);
    }
        
    /**
     * selectPlot
     *
     * @return void
     */
    public function selectPlot($estate_slug) {
        return view('frontend.parcelation.plots', compact('estate_slug'));
    }
}
