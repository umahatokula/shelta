@extends('layouts.app')

@section('content')

<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} -Change Password</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            <a href="{{ route('password.change') }}" class="btn btn-primary btn-lg">Change Password</a>
                            &nbsp;
                            <a href="{{ route('2fa.index') }}" class="btn btn-primary btn-lg">2FA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

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
                            
                            <form action="{{ route('password.change.store') }}" method="post">
                                @csrf
                                
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-3 col-form-label">Current password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password">
                                        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-3 col-form-label">New password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-3 col-form-label">New password confirmation</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="d-grid grid-2">
                                    <button class="btn btn-primary btn-lg" type="submit">Change Password</button>
                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection