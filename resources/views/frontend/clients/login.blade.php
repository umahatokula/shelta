<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate App') }} - Login</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('frontend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('frontend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <p class="text-white-50 mb-0">
                                    <a href="{{ url('/') }}" class="">
                                        <img src="{{ asset('frontend/assets/images/logo-dark.png') }}" alt="" height="80">
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">

                                <form action="{{ route('login') }}" class="form-horizontal" method="post">
                                        @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="email" value="{{ old('email') }}"
                                            class="form-control pl-15 {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-label="Email" aria-describedby="email-addon">
                                        <x-jet-input-error for="email"></x-jet-input-error>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input name="password" type="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" aria-label="Password" aria-describedby="password-addon">
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>

                                    <div class="form-check">
                                        <input name="remember" type="checkbox" class="form-check-input" id="customControlInline">
                                        <label class="form-check-label" for="customControlInline">Remember
                                            me</label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                                
										@if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted"><i
                                            class="mdi mdi-lock me-1"></i>{{ __('Forgot your password?') }}</a>
										@endif
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('frontend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>

</body>

</html>