

<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate App') }} - 2FA Verification</title>

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
                                <h5 class="text-white font-size-20">2FA Verification</h5>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">

                                <form method="POST" action="{{ route('2fa.store') }}">
                                    @csrf

                                    <p class="text-center">We sent code to your phone : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->phone,  -2) }}</p>
  
                                    <div>
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                {{ $message }}
                                            </div>
                                        @endif
                                    </div>

                                    @if ($message = Session::get('error'))
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-block">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        </div>
                                        </div>
                                    @endif
                                    <div>
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">

                                        <div class="mb-3">
                                            <label class="form-label" for="email">Code</label>
                                            <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus aria-label="Email" aria-describedby="email-addon">
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>

                                    </div>

                                    <div class="row mb-0">

                                        <div class="d-grid gap-2 mb-3">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Submit
                                            </button>

                                        </div>

                                        <div class="d-grid gap-2 ">
                                            <a class="btn btn-outline-danger btn-block" href="{{ route('2fa.resend') }}">Resend OTP</a>
                                        </div>
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