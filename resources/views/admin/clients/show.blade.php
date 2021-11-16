@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="mdi mdi-home-outline"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('clients.index') }}">Clients</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $client->sname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="box p-15">
                    <div class="row">
                        <div class="col-12">

                            @can('manage clients')
                                <div class="col-12 float-right">
                                    <a href="{{ route('clients.edit', $client) }}" class="waves-effect waves-light btn btn-primary btn-sm float-right" >Edit Profile</a>
                                    <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('clients.sendMail', $client) }}" href="#" class="waves-effect waves-light btn btn-warning btn-sm float-right mx-3">Send email</a>
                                </div>  
                            @endcan
                        
                            <div>
                                <p>
                                    <h5>{{ $client->sname }}, {{ $client->onames }}</h5>
                                </p>
                                <p>Email :<span class="text-gray ps-10"> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></span>
                                </p>
                                <p>Phone :<span class="text-gray ps-10"> <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a></span></p>
                                <p>Address :<span class="text-gray ps-10"> {{ $client->address }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <livewire:clients.show :client="$client" />
        
    </section>
@endsection