	<!--top-strip-->
	<div class="top-strip">
		<div class="container">
			<div class="top-strip-inner">
				<div class="row">

					<div class="col-md-8 col-sm-6 col-xs-6">
						<div class="link">
							<a href="mailto:Info.spenderscenter.com"> <i class="fas fa-envelope"></i> info@kroykari.com</a>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="language">
							<span><i class="fas fa-language"></i> {{__('Language')}}:</span>
								<select name="lang">
									<option @if(\App::getLocale() == 'bn') selected  @endif value="bn">{{__('Bangla')}}</option>
									<option @if(\App::getLocale() == 'en') selected  @endif value="en">{{__('English')}}</option>
								</select>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div><!--end-->

	<!--header-->
	<header>
		<div class="container">
			<div class="logo-nav clearfix">
				<a href="{{route('home')}}" class="logo">
					<img src="{{asset('public/frontend')}}/images/logo.png" alt="logo">
				</a>

				<button class="toggle-menu">
					<span></span>
					<span></span>
					<span></span>
				</button>

				<nav>
					<ul>
						<li><a class="active" href="{{route('home')}}">{{__('Home')}}</a></li>
						<li><a href="{{route('ads')}}">{{__('All Ads')}}</a></li>
						@if(auth::guest())
   						  <li class="is-not-loggedin" data-redirect="{{route('add.ad')}}"><a href="javascript:void()">{{__('Post your ad')}}</a></li>
						@else
  					  	  <li><a href="{{route('add.ad')}}">{{__('Post your ad')}}</a></li>
						@endif
						@if(auth::guest())
						   <li  class="is-not-loggedin" data-redirect="{{route('chat')}}"><a href="javascript:void(0)">{{__('Chat')}}</a></li>
						@else
							 <li><a href="{{route('chat')}}">{{__('Chat')}} <span class="badge badge-danger notification-count" data-count="0"></span></a></li>
						@endif
						<li><a href="{{route('contactUs')}}">{{__('Contact Us')}}</a></li>
							@if(Auth::guest())
							<li  class="is-not-loggedin" data-redirect="{{route('home')}}">
								<a href="javascript:void(0)" class="login-btn"><button>{{__('Login')}}/{{__('Ragister')}}</button></a>
							</li>
                            @else
						<li class="m-hide profile-icon">
							<div class="custom-dropdown">
								<div class="img dropdown-btn">
									<img onerror="profileImgError(this);" src="{{auth::user()->profile_image}}">
								</div>
								<div class="c-dropdown">
									<ul>
										<li><a href="{{route('myProfile')}}"><i class="fas fa-user"></i> {{__('My Profile')}}</a></li>
										<li><a href="{{route('myAds')}}"><i class="fas fa-list-alt"></i> {{__('My Ads')}}</a></li>
										<li><a href="{{route('favourite')}}"><i class="fas fa-heart"></i> {{__('Favourite')}}</a></li>
										<li><a href="{{route('setting')}}"><i class="fas fa-cog"></i> {{__('Setting')}}</a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											</form>
									    </li>
									</ul>
								</div>
							</div>
						</li>
							@endif
					</ul>
				</nav>
			</div>
		</div>		
	</header><!--end-->