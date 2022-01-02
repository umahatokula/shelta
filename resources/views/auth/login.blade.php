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


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post">

				@csrf

                <div class="auth-credentials m-b-xxl">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" value="{{ old('email') }}" type="email"
                        class="form-control m-b-md {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                        aria-describedby="signInEmail" placeholder="user@richboss.com">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password"
                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                        aria-describedby="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3 mb-lg-5">
                    <div class="col-12">
                        <div class="checkbox">
                            <input name="remember" type="checkbox" id="remember_me">
                            <label for="remember_me">Remember Me</label>
                        </div>
                    </div>
                </div>

                <div class="auth-submit">
                    <button type="submit" href="#" class="btn-lg btn btn-primary">Sign In</button>
					@if (Route::has('password.request'))
					<a class="auth-forgot-password float-end" href="{{ route('password.request') }}">
						<i class="ion ion-locked"></i> {{ __('Forgot your password?') }}
					</a>
					@endif
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
