<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Kroykari Bangladesh Classifieds – Best place for buying & selling anything Kroykari.com')}}</title>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="keywords" content="">
	<meta name="author" content="Codemeg Solution Pvt. Ltd., info@codemeg.com">
	<meta name="url" content="http://codemeg.com">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
	@section('meta_tag')@show
	<!--css-->
    @include('layouts.css')
    @stack('css')
</head>
<body>

    @include('layouts.header')
    
	@section('content')@show
  
  <!-- Modal -->
  <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  {{-- <h5 class="modal-title" id="loginModalLabel">Login</h5> --}}
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		 	<!--header start-->
	<section class="login-page clearfix">
		<div class="lg-wrapper">
			<div class="login-box clearfix">
				<form method="POST" action="{{ route('ajax.login') }}" aria-label="{{ __('Login') }}" id="login-form">
	                        @csrf
					<input type="hidden" name="device_token" value="">
					<input type="hidden" name="redirect" value="">
					<div class="alert alert-danger invalid-credientials" style="display: none;" role="alert">
					</div>
					<div class="alert alert-success valid-credientials" style="display: none;" role="alert">
					</div>
					<div class="login-form">
						<div class="heading">
							<h2>{{__('Login')}}</h2>
						</div>
						<div class="body">
					
						  <div class="form-group">
	                         <input type="text" placeholder="{{__('Enter Email')}}" name="email" value=""  autofocus>
	                      </div>
						  <div class="form-group">
							<input type="password" placeholder="{{__('Enter Password')}}" name="password" >
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
		</div>
	  </div>
	</div>
  </div>

    @include('layouts.footer')

<!--script-->
{{-- <script type="text/javascript" src="http://localhost:8000/socket.io/socket.io.js"></script> --}}
<script type="text/javascript" src="https://www.kroykari.com:2288/socket.io/socket.io.js"></script>
<script>
		//    const socket = io('http://localhost:8000');
       const socket = io('https://www.kroykari.com:2288');
</script>
@include('layouts.js')
<script>
	@auth
			setInterval(function(){
					socket.emit('unreadmsgcount',{sender_id:"{{auth::id()}}"});
			},1000);

			socket.on('unreadmsgcount',function(count){
				$('.notification-count').text(count);
			});

	@endauth
</script>
@stack('js')
<script type="text/javascript">
     $('.is-not-loggedin').on('click',function(e){
		 e.preventDefault();
 		 $('.invalid-credientials').hide();
		 $('.valid-credientials').hide();
		 $('span.text-error').remove();
		 $('#loginModal input[name="redirect"]').val($(this).attr('data-redirect'));	 
		 $('#loginModal').modal('show');
	 });

	 $('body').on('click','.like-ad',function(e){
	  	@if(auth::guest())
	  	  window.location.href = "{{route('login')}}";
	  	@else
		    var click = $(this);
			let id    = $(this).attr('data-id');
			let data  = {id:id};
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
				'type':'POST',
			'url' : "{{route('like')}}",
				'data' : data,
			beforeSend: function() {

			},
			'success' : function(response){
				console.log(response);
				if(response.status == 'success'){
				}
				if(response.status == 'failed'){
				}
			},
			'error' : function(error){
				console.log(error);
			},
			complete: function() {

			},
			});
		@endif
	  });
</script>
@guest
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
<script>
	$('#login-form').on('submit',function(e){
		e.preventDefault();
                let form  = $(this);
                let data = form.serialize();
				let redirect = $('input[name="redirect"]').val();
                $.ajax({
                    "headers":{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                    'type':'POST',
                    'url' : form.attr('action'),
                    'data' : data,
                beforeSend: function() {

                },
                'success' : function(response){
                    console.log(response);
                    form.find('span.text-error').remove();
                    if(response.status == 'success'){
                         $('.invalid-credientials').remove();
                         $('.valid-credientials').show();
                         $('.valid-credientials').text(response.message);
                          setTimeout(function(){ 
                            if(redirect && redirect != 'undifined')
                                  window.location.href = redirect;
                            else
                                  window.location.reload()
                          }, 1500);
                    }
                    if(response.status == 'failed'){
                         $('.invalid-credientials').text(response.message);
                         $('.invalid-credientials').show();
                    }
                    if(response.status == 'error'){
                        $.each(response.errors, function (key, val) {
                        form.find('[name='+key+']').after('<span class="text-error">'+val+'</span>');
                        });
                    }
                },
                'error' : function(error){
                    console.log(error);
                },
                complete: function() {

                },
                });
	});
</script>
@endguest
</body>
</html>
