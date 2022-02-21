<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Estate;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyPrice;
use App\Helpers\PaginationHelper;
use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Builder;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['estates'] = Estate::all();
        $data['propertyTypes'] = PropertyType::all();
        $data['propertyPrices'] = PropertyPrice::all();
        $data['paymentPlans'] = PaymentPlan::all();
        $estate_id = null;
        $property_type_id = null;
        $price_id = null;
        $plan_id = null;
        $unique_number = null;

        $propertiesQuery = Property::query();
        $propertiesQuery = $propertiesQuery
        // ->whereNotNull('client_id')
        ->orderBy('unique_number', 'asc');
        
        if (request('price_id')) {
            $price_id = request('price_id');
            $propertiesQuery = $propertiesQuery
                ->whereHas('estatePropertyType.estatePropertyTypePrices.propertyPrice', fn (Builder $q) => $q->whereId($price_id));

        }
        
        if (request('plan_id')) {
            $plan_id = request('plan_id');
            $propertiesQuery = $propertiesQuery
                ->whereHas('estatePropertyType.estatePropertyTypePrices', function (Builder $q) use($plan_id) {
                    $q->where('payment_plan_id', '=', $plan_id);
                });
            
        }

        if (request('estate_id')) {
            $estate_id = request('estate_id');
            $propertiesQuery = $propertiesQuery
                ->whereHas('estatePropertyType', function (Builder $q) use($estate_id) {
                    $q->where('estate_id', '=', $estate_id);
                });
        }
    
        if (request('property_type_id')) {
            $property_type_id = request('property_type_id');
            $propertiesQuery = $propertiesQuery
                ->whereHas('estatePropertyType', function (Builder $q) use($property_type_id) {
                    $q->where('property_type_id', '=', $property_type_id);
                });
        }
        
        if (request('unique_number')) {
            $unique_number = request('unique_number');
            $propertiesQuery = $propertiesQuery->where('unique_number', 'LIKE', '%'.$unique_number.'%');
            
        }
        

        $data['unique_number'] = $unique_number;
        $data['price_id'] = $price_id;
        $data['plan_id'] = $plan_id;
        $data['estate_id'] = $estate_id;
        $data['property_type_id'] = $property_type_id;
        $data['properties'] = $propertiesQuery->with('client.transactions')->paginate(20);

        return view('admin.properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.properties.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['property'] = Property::findOrfail($id);
        return view('admin.properties.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $data['property'] = $property;
        return view('admin.properties.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $property_number = Property::findOrFail($id)->unique_number;
        DB::transaction(function () use($id) {

            Property::findOrFail($id)->delete();

            // delete all transsactions of this property
            Transaction::where('property_id', $id)->delete();

        });

        session()->flash('message', 'Property #'.$property_number.' deleted.');
        return redirect()->route('properties.index');
    }
}
