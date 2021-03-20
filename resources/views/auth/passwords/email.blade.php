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
                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

					 <input type="hidden" name="device_token" value="">
                     @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ __('A reset link sent to your email address') }}
                     </div>
                    @endif
					<div class="login-form">
						<div class="logo">
							<img src="{{asset('frontend')}}/images/logo.png">
						</div>
						<div class="heading">
							<h2>{{ __('Reset Password') }}</h2>
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
		
							<div class="lgn-btn">
								<a href="{{route('login')}}"><button>  {{ __('Send Password Reset Link') }}</button></a>
							</div>
                            
						</div>
					</div>
				</form>
	
			</div>
		</div>
	</section><!--end header-->
@include('layouts.js')
</body>
</html>