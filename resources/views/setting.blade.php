@extends('layouts.app')
@section('content')

	<div class="navcigation padding-top">
		<div class="container">
			<ul>
				<li><a href="{{route('home')}}">{{__('Home')}}</a></li>
				<li><a href="{{route('favourite')}}">{{__('Setting')}}</a></li>
			</ul>
		</div>
	</div>
	<!--post add-->
	<section class="profile-page">
		<div class="container">
			<div class="row">
				<!--profile-tabs-->
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="profile-tabs">
						<ul class="nav nav-tabs">
							<li><a href="{{route('myProfile')}}"><i class="fas fa-user"></i> {{__('My Profile')}}</a></li>
							<li><a href="{{route('myAds')}}"><i class="fas fa-list-alt"></i> {{__('My Ads')}}</a></li>
							<li><a href="{{route('favourite')}}"><i class="fas fa-list-alt"></i> {{__('Favourite')}}</a></li>
							  <li><a class="active" href="{{route('setting')}}"><i class="fas fa-cog"></i> {{__('Setting')}}</a></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											</form>
									    </li>
						</ul>
					</div>
				</div><!--end-->

				<!--profile data-->
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="profile-data">
						<div class="tab-content">

							<div id="MyAds" class="tab-pane fade active show">
								<div class="tab-data">
									<div class="header">
										<h2>{{__('Setting')}}</h2>
									</div>
									<div class="body">
									</div>
								</div>
							</div>

						</div>
					</div>
				</div><!--end-->
			</div>
		</div>
	</section><!--end-->
	
    @endsection