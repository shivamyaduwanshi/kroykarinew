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

    <style>
        .login-box {
            padding: 30px !important;
        }
        .form-group {
            margin: 0 0 15px;
        }
        .form-group label {
            margin: 0 0 5px;
            font-size: 14px;
            color: #000;
        }
        .form-group input.form-control{
            height: 38px;
        }
        .buttons button{
            width: 100%;
            background: #004181;
        }
        .heading{
            margin:  0 0 20px;
        }
        .heading h2{
            margin: 0;
            font-size: 18px;
            color: #004181;
        }
    </style>
</head>
<body>
	<!--header start-->
	<section class="login-page login clearfix">
		<div class="back-home">
			<a href="{{route('home')}}"><i class="fas fa-arrow-left"></i> {{__('Back to Home')}}</a>
		</div>

		<div class="lg-wrapper">
			<div class="login-box clearfix">
                    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading">
                                    <h2>Reset your password</h2>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {{-- <label>{{ __('E-Mail Address') }}</label> --}}
    
                                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    {{-- <label>{{ __('Password') }}</label> --}}
    
                                    <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    {{-- <label>{{ __('Confirm Password') }}</label> --}}
    
                                    <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="buttons">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
