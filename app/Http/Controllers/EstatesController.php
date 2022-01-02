<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\PropertyType;
use Illuminate\Http\Request;


class EstatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.estates.list-estates');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estates.create-estate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $estate)
    {
        $data['estate'] = $estate;

        return view('admin.estates.edit-estate', $data);
    }

}
