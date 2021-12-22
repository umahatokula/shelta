@extends('layouts.frontend')

@section('content')

<div class="rs-services-single pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container custom">
         <div class="row">
             <div class="col-lg-3">
                 <ul class="services-list">
                     <li><a class="active" href="{{ route('frontend.clients.profile') }}">My Profile</a></li>
                     <li><a href="{{ route('frontend.clients.security') }}">Security</a></li>
                 </ul>
             </div>
             <div class="col-lg-9 pr-45 md-pr-15 md-mb-50">
                <div class="rs-contact contact-style2">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>
                        
                        <form action="{{ route('frontend.clients.profile.updateClientProfileRequest') }}" method="post">
                            @csrf

                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Surname Name</label>
                                <div class="col-md-10">
                                    {!! Form::text('sname', $client->sname, ['class' => 'from-control']) !!}
                                    @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Other Names</label>
                                <div class="col-md-10">
                                    {!! Form::text('onames', $client->onames, ['class' => 'from-control']) !!}
                                    @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Phone Number</label>
                                <div class="col-md-10">
                                    {!! Form::text('phone', $client->phone, ['class' => 'from-control']) !!}
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    {!! Form::email('email', $client->email, ['class' => 'from-control']) !!}
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="d-grid grid-2">
                                <button class="readon submit" type="submit">Update profile</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
         </div> 
    </div> 
 </div>

@endsection