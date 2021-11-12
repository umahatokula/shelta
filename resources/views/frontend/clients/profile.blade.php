@extends('layouts.frontend')

@section('content')
<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">My Profile</h4>
    
    
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Main content -->

    <div class="row">

        <div>
            @if (session()->has('message'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-12">
            <div class="card p-15">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                    aria-selected="true">My Bio</a>
                                <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                    aria-selected="false">Security</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <p>
                                            {!! Form::model($client, ['route' => ['frontend.clients.profile.updateClientProfileRequest', $client->id], 'method' => 'PUT']) !!}
                                            
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Surname Name</label>
                                                <div class="col-md-10">
                                                    {!! Form::text('sname', null, ['class' => 'form-control']) !!}
                                                    @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Other Names</label>
                                                <div class="col-md-10">
                                                    {!! Form::text('onames', null, ['class' => 'form-control']) !!}
                                                    @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Phone Number</label>
                                                <div class="col-md-10">
                                                    {!! Form::number('phone', null, ['class' => 'form-control']) !!}
                                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-10">
                                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Update profile</button>
                                        </form>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <p>
                                        <form action="{{ route('frontend.clients.profile.toggle2FA') }}" method="post">
                                            @csrf

                                            <div class="mb-3 row my-5">
                                                <label for="example-text-input" class="col-md-7 col-form-label">Do you want to enable or disable Two Factor Authentication? 

                                                <br> 

                                                (Currently <span class="text-{{ auth()->user()->use_2fa ? 'success' : 'danger' }}">{{ auth()->user()->use_2fa ? 'Enabled' : 'Disabled' }}</span>)</label>

                                                <div class="col-md-5">

                                                    <button class="btn btn-{{ auth()->user()->use_2fa ? 'danger' : 'success' }}" >{{ auth()->user()->use_2fa ? 'Disable Two Factor Authentication' : 'Enable Two Factor Authentication' }}</button>
                                                </div>
                                            </div>

                                        </form>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection