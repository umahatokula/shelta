@extends('layouts.frontend')

@section('content')

<div class="rs-services-single pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container custom">
         <div class="row">
             <div class="col-lg-3">
                 @include('frontend.mini-sidebar')
             </div>
             <div class="col-lg-9 pr-45 md-pr-15 md-mb-50">
                <div class="rs-contact contact-style2">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>
                        
                        

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('info'))
                            <div class="alert alert-info">
                                {{ session('info') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('frontend.password.change.store') }}" method="post">
                            @csrf
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-3 col-form-label">Current password</label>
                                <div class="col-md-9">
                                    <input type="password" class="from-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password">
                                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-3 col-form-label">New password</label>
                                <div class="col-md-9">
                                    <input type="password" class="from-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-3 col-form-label">New password confirmation</label>
                                <div class="col-md-9">
                                    <input type="password" class="from-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="d-grid grid-2">
                                <button class="readon submit" type="submit">Change Password</button>
                            </div>

                        </form>
                        
                    </div>
                </div>
            </div>
         </div> 
    </div> 
 </div>

@endsection