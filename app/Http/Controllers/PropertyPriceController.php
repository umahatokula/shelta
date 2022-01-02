<?php

namespace App\Http\Controllers;

use App\Models\PropertyPrice;
use Illuminate\Http\Request;

class PropertyPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.property-prices.prices');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property-prices.create-price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyPrice  $propertyPrice
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyPrice $propertyPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyPrice  $propertyPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyPrice $propertyPrice)
    {
        $data['propertyPrice'] = $propertyPrice;

        return view('admin.property-prices.edit-price', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyPrice  $propertyPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyPrice $propertyPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyPrice  $propertyPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyPrice $propertyPrice)
    {
        //
    }
}
