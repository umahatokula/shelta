<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Imports\PropertyImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportsController extends Controller
{    
    /**
     * importClients
     *
     * @return void
     */
    public function importClients() {
        return view('admin.imports.imports');
    }
    
    /**
     * importClientsStore
     *
     * @param  mixed $request
     * @return void
     */
    public function importClientsStore(Request $request) {
        // dd($request->all());

        Excel::import(new ClientsImport, request()->file('clients_file'));

        // session()->flash('Clients imported successfully');
        Session::flash('message', 'Clients imported successfully'); 
        Session::flash('alert-class', 'alert-success');
        
        return redirect()->route('imports.clients');
    } 
    /**
     * importClients
     *
     * @return void
     */
    public function importProperty() {
        return view('admin.imports.imports');
    }
    
    /**
     * importClientsStore
     *
     * @param  mixed $request
     * @return void
     */
    public function importPropertyStore(Request $request) {
        // dd($request->all());

        Excel::import(new PropertyImport, request()->file('property_file'));

        // session()->flash('Clients imported successfully');
        Session::flash('message', 'Clients imported successfully'); 
        Session::flash('alert-class', 'alert-success');
        
        return redirect()->route('imports.clients');
    }
}
