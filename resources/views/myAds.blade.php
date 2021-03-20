@extends('layouts.app')
@section('content')

	<div class="navcigation padding-top">
		<div class="container">
			<ul>
				<li><a href="{{route('home')}}">{{__('Home')}}</a></li>
				<li><a href="{{route('myAds')}}">{{__('My Ads')}}</a></li>
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
							<li><a class="active" data-toggle="tab" href="#{{route('myAds')}}"><i class="fas fa-list-alt"></i> {{__('My Ads')}}</a></li>
							<li><a  href="{{route('favourite')}}"><i class="fas fa-list-alt"></i> {{__('Favourite')}}</a></li>
							  {{-- <li><a href="{{route('setting')}}"><i class="fas fa-cog"></i> {{__('Setting')}}</a></li> --}}
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
										<h2>{{__('My Ads')}}</h2>
									</div>
									<div class="body">
										<div class="ads-list">
											<!--single-ads-->
											@php
											  $ads = \App\Models\Ad::where('user_id',auth::id())->whereNull('deleted_at')->orderBy('id','desc')->get();
											@endphp
											@forelse($ads as $ad)
												<div class="single-ads">
													<div class="delete-edit">
														<button class="delete"><i data-url="{{route('adDelete',$ad->id)}}" class="fas fa-trash btn-dlt"></i></button>
														<a class="edit" href="{{route('editAd',$ad->id)}}"><i class="fas fa-pen"></i></a>
													</div>
													
													@if($ad->is_approved == '0')
													    <span class="under-review">{{ __('Under Review')  }}</span>
													@endif

													@if($ad->is_approved == '2')
													<span class="reject-ad">{{ __('Rejected')  }}</span>
												    @endif
													
													<a href="{{route('adShow',[$ad->id,urlencode($ad->title)])}}">
														<div class="img-txt clearfix">
															<div class="img">
																<img src="{{$ad->image}}" alt="ads image">
															</div>
															
															<div class="txt">
																<h2>{{$ad->title}}</h2>
																<div class="lc">
																	<h3>
																		<i class="fa fa-map-marker-alt"></i>
																		<span>{{__('Location')}}:</span>
																		{{$ad->area->title_name}}&nbsp;({{$ad->city->title_name}})
																	</h3>
																	<h3>
																		<i class="fa fa-briefcase"></i>
																		<span>{{__('Category')}}:</span>
																		{{$ad->category->title_name}}
																		<label class="sale tag">{{$ad->subCategory->title_name}}</label>
																	</h3>
																	<h3>
																		<i class="fa fa-clock"></i>
																		{{$ad->created_at->diffForHumans()}}
																	</h3>
																</div>
						
																<p>{{$ad->description}}</p>
						
																<label class="price">৳ {{$ad->price}}</label>
															</div>
														</div>
													</a>
												</div><!--end-->
											@empty
											@endforelse
										</div>
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
    @push('css')
       <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/image-uploader.min.css">
    @endpush
    @push('js')
       <script type="text/javascript" src="{{asset('public/frontend')}}/js/sweetalert.min.js"></script>
       <script type="text/javascript">
       	 $('body').on('click','.btn-dlt',function(e){
		  	  var url   = $(this).attr('data-url');
		  	  var click = $(this);
			  swal({
			  title: "{{__('Are you sure?')}}",
			  text: "{{__('Once deleted, you will not be able to recover this ad!')}}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			 })
			 .then((willDelete) => {
				if(!willDelete){
					return false;
				}
					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'GET',
						'url' : url,
					beforeSend: function() {
					},
					'success' : function(response){
						if(response.status == 'success'){
							click.parents('.single-ads').remove();
							toastr.success(response.message);
						}
						if(response.status == 'failed'){
							toastr.error(response.message);
						}
					},
					'error' : function(error){
					},
					complete: function() {
					},
					});
			 });
	     });
       </script>
    @endpush