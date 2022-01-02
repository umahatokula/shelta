<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>{{ config('app.name', 'Real Estate App') }}</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/plugins/pace/pace.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('assets') }}/css/main.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets') }}/images/logo_richboss.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/images/logo_richboss.png" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="{{ route('home') }}">&nbsp</a>
            </div>
            <p class="auth-description">&nbsp</p>


            @if (session('status'))
            <div class="alert alert-success mb-3 rounded-0" role="alert">
                {{ session('status') }}
            </div>
            @endif
            
                <form method="POST" action="{{ route('2fa.store') }}">
                    @csrf

                    <p class="text-center">We sent an OTP to your email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->phone,  -2) }}</p>

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

                        <div class="col-12 mb-3">
                            <label class="form-label" for="email">Enter OTP</label>
                            <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus aria-label="Email" aria-describedby="email-addon">
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="d-grid grid-2 mb-2 mb-md-4">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>

                        </div>

                        <div class="d-grid grid-2">
                            <a class="btn btn-outline-danger btn-lg" href="{{ route('2fa.resend') }}">Resend OTP</a>
                        </div>
                    </div>
                </form>

        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('assets') }}/js/main.min.js"></script>
    <script src="{{ asset('assets') }}/js/custom.js"></script>
</body>

</html>
