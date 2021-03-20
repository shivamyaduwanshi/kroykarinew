<!DOCTYPE html>
<html>
<head>
	<title>{{__('kroykari')}}</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="author" content="Codemeg Solution Pvt. Ltd., info@codemeg.com">
	<meta name="url" content="https://kroykari.com">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
	<!--css-->
    @include('layouts.css')
</head>
<body>
	<!--header start-->
	<section class="login-page login clearfix">
		<div class="back-home">
			<a href="{{route('home')}}"><i class="fas fa-arrow-left"></i> {{__('Back to Home')}}</a>
		</div>

		<div class="lg-wrapper">
			<div class="login-box clearfix">
				<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" id="login-form">
	                        @csrf
							<input type="hidden" name="device_token" value="">
					  @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('message') }}
	                        </div>
	                  @endif
					<div class="login-form">
						<div class="logo">
							<img src="{{asset('frontend')}}/images/logo.png">
						</div>
						<div class="heading">
							<h2>{{__('Login')}}</h2>
							<p>{{__('Welcome Back..!!')}}</p>
						</div>
						<div class="body">

							<div class="language">
							<span><i class="fas fa-language"></i> {{__('Language')}}:</span>
								<select name="lang">
									<option @if(\App::getLocale() == 'bn') selected  @endif value="bn">{{__('Bangla')}}</option>
									<option @if(\App::getLocale() == 'en') selected  @endif value="en">{{__('English')}}</option>
								</select>
							</div>
					
						  <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
	                                <input type="text" placeholder="{{__('Enter Email')}}" name="email" value="{{ old('email') }}"  autofocus>
	                                 @if ($errors->has('email'))
	                                     <span class="invalid-feedback text-error" role="alert">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                     </span>
                                     @endif
	                            </div>
	                            <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
	                                <input type="password" placeholder="{{__('Enter Password')}}" name="password" >
	                                @if ($errors->has('password'))
	                                    <span class="invalid-feedback  text-error" role="alert">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
                                     @endif
	                            </div>
		
							<div class="frgt-pass">
								<a href="{{ route('password.request') }}">{{__('Forgot Password?')}}</a>
							</div>
		
							<div class="lgn-btn">
								<a href="{{route('login')}}"><button>{{__('Login')}}</button></a>
							</div>
                            <div class="or"><span>OR</span></div>
							<div class="social-login">
								<a href="{{route('facebook.login')}}"><i class="fab fa-facebook-square"></i>&nbsp;{{__('Continue with facebook')}}</></a>
							</div>
		
							<div class="link">
								<p>{{__('Don’t have an account?')}}' <a href="{{route('register')}}"> {{__('Sign Up')}}</a> </p>
							</div>
						</div>
					</div>
				</form>
	
			</div>
		</div>
	</section><!--end header-->
@include('layouts.js')
<script>
  		// Your web app's Firebase configuration
		// For Firebase JS SDK v7.20.0 and later, measurementId is optional
		var firebaseConfig = {
			apiKey: "AIzaSyA--ohqdRW1EpW4DSnxuYSycDObj_IItC0",
			authDomain: "kroykari.firebaseapp.com",
			projectId: "kroykari",
			storageBucket: "kroykari.appspot.com",
			messagingSenderId: "457325902282",
			appId: "1:457325902282:web:1c714f424d7986015ff733",
			measurementId: "G-VQNE9JF86G"
		};		

		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);

		// Retrieve Firebase Messaging object.
		const messaging = firebase.messaging();
		messaging.usePublicVapidKey("BBJQA2cfKUcGdmbly7CqOnpW8C2SaMBtmfQPMQefpQDjVJTrqJa5qgaGLbeAfwXrOYB1K76pXAdcg42KpofUji8");

		messaging.requestPermission()
		 .then(function () {
		     console.log(messaging.getToken());
		     return messaging.getToken();
		 })
		 .then(function (token) {
		     $('input[name="device_token"]').val(token);
		 })
		 .catch(function (err) {
		    console.log(err);
		});
</script>
</body>
</html>