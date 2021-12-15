@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Imports</h1>
                <span>All initial system imports are done here.</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>

                <div class="card-body">
                    <h4>Clients Upload</h4>
                    <div class="example-container">
                        <div class="example-content">

                            @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif

                            {!! Form::open(['route' => 'imports.clients.store', 'files' => true, 'class' => '']) !!}
                            <div class="row">
                                <div class="col-12 mb-3">

                                    {!! Form::file('clients_file', ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Import</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <h4>Properties Upload</h4>
                    <div class="example-container">
                        <div class="example-content">

                            @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif

                            
                            {!! Form::open(['route' => 'imports.clients.store', 'files' => true, 'class' => '']) !!}
                            <div class="row">
                                <div class="col-12 mb-3">

                                    {!! Form::file('property_file', ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Import</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection