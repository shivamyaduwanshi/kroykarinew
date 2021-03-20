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
				
				<div class="login-form">
					<div class="logo">
							<img src="{{asset('frontend')}}/images/logo.png">
					</div>
					<div class="heading">
						<h2>{{__('Register')}}</h2>
						<p>{{__('Enter All the details')}}</p>
					</div>
					<div class="body">
                       <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" autocomplete="on">
                            @csrf
                       	<input type="hidden" name="device_token" value="">
	                    <div class="language">
						<span><i class="fas fa-language"></i> {{__('Language')}}:</span>
							<select name="lang">
								<option @if(\App::getLocale() == 'bn') selected  @endif value="bn">{{__('Bangla')}}</option>
								<option @if(\App::getLocale() == 'en') selected  @endif value="en">{{__('English')}}</option>
							</select>
						</div>
						
						<div class="form-group {{ $errors->has('user_name') ? ' is-invalid' : '' }}">
	                        <input type="text" placeholder="{{__('User Name')}}" name="user_name" value="{{old('user_name')}}">
	                        @if ($errors->has('user_name'))
	                            <span class="invalid-feedback" role="alert">
	                                 <strong>{{ $errors->first('user_name') }}</strong>
	                            </span>
	                        @endif
	                    </div>
						<div class="form-group {{ $errors->has('phone_number') ? ' is-invalid' : '' }}">
	                        <input type="text" placeholder="{{__('Phone number')}}" name="phone_number" value="{{old('phone_number')}}">
	                        @if ($errors->has('phone_number'))
	                            <span class="invalid-feedback" role="alert">
	                                 <strong>{{ $errors->first('phone_number') }}</strong>
	                            </span>
	                        @endif
	                    </div>
						<div class="form-group {{ $errors->has('email_address') ? ' is-invalid' : '' }}">
	                        <input type="text" placeholder="{{__('Email address')}}" name="email_address" value="{{old('email_address')}}">
	                        @if ($errors->has('email_address'))
	                            <span class="invalid-feedback" role="alert">
	                                 <strong>{{ $errors->first('email_address') }}</strong>
	                            </span>
	                        @endif
	                    </div>
					   <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                <input type="password" placeholder="Password" name="password" autocomplete="off">
                                @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                 @endif
                        </div>
						<div class="form-group">
							<input type="password" placeholder="{{__('Confirm Password')}}" name="password_confirmation">
						</div>
							<label class="term-condition-input"><input type="checkbox" name="term_and_condition" @if(old('term_and_condition')) checked @endif value="1"/>&nbsp;&nbsp;I have read and agreed to <a href="{{route('page','terms-and-conditions')}}">Term & Conditions</a></label>
							@if ($errors->has('term_and_condition'))
								<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('term_and_condition') }}</strong>
								</span>
							@endif
							<div class="lgn-btn">
							<button>{{__('Sign Up')}} </button>
						</div>
						<div class="or"><span>{{__('OR')}}</span></div>
						<div class="social-login">
							<a href="{{route('facebook.login')}}"><i class="fab fa-facebook-square"></i>&nbsp;{{__('Continue with facebook')}}</></a>
							</div>
	
						<div class="link">
							<p>{{__('Already have an account?')}}' <a href="{{route('login')}}"> {{__('Sign In')}}</a> </p>
						</div>
					</form>
					</div>
				</div>
	
			</div>
		</div>
	</section><!--end header-->

<!--script-->
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