@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Client's Details</h1>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="col-lg-12">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            <div class="row">
                                <div class="col-12">

                                    @can('manage clients')
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary" >Edit Profile</a>

                                        <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('clients.resetPassword', $client) }}" href="#" class="btn btn-success">Reset Password</a>

                                        <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('clients.sendMail', $client) }}" href="#" class="btn btn-warning">Send notification</a>
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
        </div>

        <livewire:clients.show :client="$client" />

        </div>
    </div>
@endsection
