

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
	
<body class="hold-transition theme-primary bg-img" style="background-image: url({{ asset('assets/images/auth-bg/bg-hall7.jpg') }})">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<img src="{{ asset('assets/images/hall7_logo.png') }}" alt="" class="img-fluid" style="max-width: 100px;">						
							</div>
							<div class="p-40">

								@if (session('status'))
									<div class="alert alert-success mb-3 rounded-0" role="alert">
										{{ session('status') }}
									</div>
								@endif

								<form action="{{ route('login') }}" method="post">
                                    @csrf
                                    
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input name="email" type="email" value="{{ old('email') }}" class="form-control pl-15 bg-transparent{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
											<x-jet-input-error for="email"></x-jet-input-error>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input name="password" type="password" class="form-control pl-15 bg-transparent{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
											<x-jet-input-error for="password"></x-jet-input-error>
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input name="remember" type="checkbox" id="remember_me" >
											<label for="remember_me">Remember Me</label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-6">
										 <div class="fog-pwd text-right">

                                            @if (Route::has('password.request'))
                                                <a class="hover-warning" href="{{ route('password.request') }}">
                                                    <i class="ion ion-locked"></i> {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
											<br>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
										</div>
										<!-- /.col -->
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
