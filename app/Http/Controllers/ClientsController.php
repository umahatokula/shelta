<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('client')) {

            $data['clients'] = Client::paginate(20);

            return view('frontend.clients.index', $data);
        }

        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
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
    public function show(Client $client)
    {
        
        $data['client'] = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);

        if (auth()->user()->hasRole('client')) {
    
            return view('frontend.clients.show', $data);
        }

        return view('admin.clients.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $data['client'] = $client;
        return view('admin.clients.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $data['client'] = $client;
        return view('admin.clients.destroy', $data);
    }
    
    /**
     * addProperty
     *
     * @param  mixed $client
     * @return void
     */
    public function addProperty(Client $client) {
        $data['client'] = $client;
        return view('admin.clients.add-property', $data);
    }
    
    /**
     * login
     *
     * @return void
     */
    public function login() {
        return view('frontend.clients.login');
    }
}
