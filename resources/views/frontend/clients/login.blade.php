


<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate App') }} - Login</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('frontend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('frontend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('frontend/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="">
    
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">

                                <form action="{{ route('login') }}" method="post">
                                    @csrf

                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input name="email" type="email" value="{{ old('email') }}"
                                                class="form-control pl-15 {{ $errors->has('email') ? ' is-invalid' : '' }}"
												placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>

                                        <label>Password</label>
                                        <div class="mb-3">
											<input name="password" type="password"
												class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
												placeholder="Password" aria-label="Password" aria-describedby="password-addon">
											<x-jet-input-error for="password"></x-jet-input-error>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input name="remember" class="form-check-input" type="checkbox" id="remember_me" checked="">
                                            <label class="form-check-label" for="remember_me">Remember me</label>
                                        </div>
										
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">

                                        Don't have an account?
										@if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-info text-gradient font-weight-bold">{{ __('Forgot your password?') }}</a>
										@endif
										
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url({{ asset('frontend/assets/img/curved-images/curved6.jpg') }})"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!--   Core JS Files   -->
    <script src="{{ asset('frontend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('frontend/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
