@extends('layouts.frontend')

@section('content')

<div class="rs-services-single pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container custom">
         <div class="row">
             <div class="col-lg-3">
                 <ul class="services-list">
                     <li><a href="{{ route('frontend.clients.profile') }}">My Profile</a></li>
                     <li><a class="active" href="{{ route('frontend.clients.security') }}">Security</a></li>
                 </ul>
             </div>
             <div class="col-lg-9 pr-45 md-pr-15 md-mb-50">
                 
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
             </div>
         </div> 
    </div> 
 </div>

@endsection