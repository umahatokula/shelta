<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        if ($user->hasRole('staff')) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('frontend.dashboard');
        return view('dashboard');
    }

    public function clientDashboard() {
        return redirect()->route('frontend.clients.payments');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

}
