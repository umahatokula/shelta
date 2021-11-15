

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
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('assets/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/skin_color.css"') }}>	

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url({{ asset('assets/images/auth-bg/bg-ochacho.jpg') }})">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<img src="{{ asset('assets/images/logo-light.png') }}" alt="" class="img-fluid" style="max-width: 200px;">						
							</div>
							<div class="p-40">

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
                                            <label class="form-label" for="email">OTP</label>
                                            <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus aria-label="Email" aria-describedby="email-addon">
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Submit
                                            </button>

                                        </div>

                                        <div class="col-12 ">
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


	<!-- Vendor JS -->
	<script src="{{ asset('assets/js/vendors.min.js') }}"></script>
	<script src="{{ asset('assets/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>	

</body>

</html>
