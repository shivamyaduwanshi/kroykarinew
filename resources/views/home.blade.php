@extends('layouts.app')
@section('content')
 <!--header-slider-->
	<section class="header-slider">
		<div class="container-fluid">
			<div class="slider-txt">
				<div class="slider-body">
					<div class="owl-carousel">
						<img class="owl-lazy" data-src="{{asset('frontend')}}/images/01.jpg" alt="slider Image">
						<img class="owl-lazy" data-src="{{asset('frontend')}}/images/01.jpg" alt="slider Image">
						<img class="owl-lazy" data-src="{{asset('frontend')}}/images/01.jpg" alt="slider Image">
					</div>
				</div>
				{{-- <div class="top-heading">
					<h2>{{__('Welcome to kroykari.com The Largest Marketplace in Bangladesh')}} </h2>
				</div> --}}
				<div class="searchbar-txt">
					<h3>{{__('Welcome to kroykari.com The Largest Marketplace in Bangladesh')}} </h3>
					<h2>{{__('The best place to buy and sell everything or find a job in Bangladesh')}} </h2>
					<div class="searchbar">

						<div class="cat-link-icon">
							<ul>
								<li>{{__('Searching in')}}</li>
								<li><a href="{{route('ads')}}">{{__('All')}}</a></li>
								@forelse($data['categories'] as $key => $category)
								  @if($key == 6)
								    @break
								  @endif
								  <li>
									  	<a href="{{route('ads',['cat'=>$category->title_value])}}">
											<img src="{{$category->image}}">
											<span> {{$category->title_name}}</span>
										</a>
									</li>
								@empty
								@endforelse
							</ul>
						</div>

						<div class="inner">
							<i class="fas fa-search"></i>
							<form action="{{route('ads')}}">
								<input type="search" placeholder="{{__('Search here')}}" name="search" id="">
								<button>{{__('Search')}}</button>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section><!--END header-slider-->

	<!--steps-cart-->
	<section class="browse-category-wrapper">
		<div class="container">
			<!--steps-cart-->
			<div class="steps-cart">
				<div class="process">
					<div class="row">
						<!--single process-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<a href="{{route('register')}}">
								<div class="single-box clearfix">
									<div class="img">
										<img src="{{asset('frontend')}}/images/icon1.png">
									</div>
									<div class="txt">
										<h2>{{__('Create an Account')}}</h2>
										<p>{{__('A single username and password gets you into everything in Kroykari')}}</p>
									</div>
								</div>
							</a>
						</div>
						<!--end-->
	
						<!--single process-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<a href="{{route('add.ad')}}">
							<div class="single-box clearfix">
								<div class="img">
									<img src="{{asset('frontend')}}/images/icon2.png">
								</div>
								<div class="txt">
									<h2>{{__('Submit Your Ad')}}</h2>
									<p>{{__('Use this form to submit a classified ad')}}</p>
								</div>
							</div>
					    	</a>
						</div>
						<!--end-->
	
						<!--single process-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<a href="{{route('ads')}}">
								<div class="single-box clearfix">
									<div class="img">
										<img src="{{asset('frontend')}}/images/icon3.png">
									</div>
									<div class="txt">
										<h2>{{__('Make a Deal')}}</h2>
										<p>{{__('To successfully achieve or negotiate a deal or agreement')}}</p>
									</div>
								</div>
							</a>
						</div>
						<!--end-->
						
					</div>
				</div>
			</div><!--end-->

			<!--heading-->
			<div class="heading">
				<h2>{{__('Browse By Category')}}</h2>
				<p>{{__('To browse through lists of items for buy & Sell on kroykari by category')}}</p>
			</div> <!--end-->

			<!--browse by catergory-->
			<div class="browse-category">
				<div class="row">
					<!--categories-->
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="categories-box">
							<div class="row">
								@forelse($data['categories'] as $category)
								<!--single category-->
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="single-category">
										<a href="{{route('ads',['cat'=>$category->title_value])}}">
											<img src="{{$category->image}}" alt="category icon">
											<div class="txt">
												<h2>{{$category->title_name}}</h2>
												<span>{{$category->totalAd() > 100 ? $category->totalAd() . '+' : $category->totalAd() }} {{__('Available')}}</span>
											</div>
										</a>
									</div>
								</div><!--end-->
								@empty
								@endforelse
							</div>
						</div>
					</div><!--end-->

					<!--filter-links-->
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="filter-links">
							<h2>{{__('Cities')}}</h2>
							<ul>
								@forelse($data['cities'] as $city)
								   @if($city->type == 'division') @continue @endif
								   <li><a href="{{route('ads',['city'=>$city->title_value])}}">{{$city->title_name}}</a></li>
								@empty
								@endforelse
							</ul>
						</div>

						<div class="filter-links">
							<h2>{{__('Divisions')}}</h2>
							<ul>
								@forelse($data['cities'] as $city)
            					   @if($city->type == 'city') @continue @endif
								   <li><a href="{{route('ads',['city'=>$city->title_value])}}">{{$city->title_name}}</a></li>
								@empty
								@endforelse
							</ul>
						</div>
					</div><!--end-->
				</div>
			</div><!--end-->
		</div>
	</section><!--end-->

	<!--top ads-->
	<section class="top-ads">
		<div class="container">
			<!--heading-->
			<div class="heading">
				<h2>{{__('Top Ads')}}</h2>
			</div> <!--end-->

			<div class="row">
				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="ads-list">
						<!--single-ads-->
						@forelse($data['ads'] as $ad)
						<a href="{{route('adShow',[$ad->id,urlencode($ad->title)])}}">
							<div class="single-ads">
				 				<button class="like-btn" >
									<label>
										<input type="checkbox" @if($ad->is_like)  checked  @endif name="heart">
										<span><i class="fa fa-heart like-ad" data-id="{{$ad->id}}"></i></span>
									</label>
								</button>
								<img class="featured-tag" src="{{asset('frontend')}}/images/featured.png" alt="">
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
													{{$ad->category->title_name ?? ''}}
													<label class="sale tag">{{ $ad->subCategory->title_name ?? '' }}</label>
												</h3>
												<h3>
													<i class="fa fa-clock"></i>
													{{$ad->created_at->diffForHumans()}}
												</h3>
											</div>

											<p>{{$ad->description}}</p>

											<label class="price">৳ {{number_format($ad->price,2)}}</label>
										</div>
									</div>
							</div><!--end-->
						</a>
						@empty
						@endforelse
					</div>

					<!--pagination-->
				{{-- 	<div class="ads-pagination">
						<div class="wrapper">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-3">
									<button class="preview"><i class="fas fa-arrow-left"></i> Pre.</button>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<div class="pagination-number">
										<ul>
											<li><a href="javascript:void(0);">1</a></li>
											<li><a class="active" href="javascript:void(0);">2</a></li>
											<li><a href="javascript:void(0);">3</a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-3 text-right">
									<button class="preview">Next <i class="fas fa-arrow-right"></i></button>
								</div>
							</div>
						</div>
					</div> --}}
					<!--end-->

				</div>

				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="google-ads">
						<img src="{{asset('frontend')}}/images/ad.jpg" alt="google ads" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</section><!--end-->

	<!--download app-->
	<section class="download-app">
		<div class="container">
			<div class="body clearfix">
				<div class="mobile"><img src="{{asset('frontend')}}/images/mobile.png"></div>
				<div class="txt-btn">
					<div class="heading">
						<h2>{{__('Download Our App')}}</h2>
						<p>{{__('Find amazing deals on the go Download Our App')}}</p>
					</div>
	
					<div class="download-btn">
						<div class="btns">
							<a href="https://play.google.com/store/apps/details?id=kroykari.app.com" target="_blank"><button> <img src="{{asset('frontend')}}/images/playstore.png"> {{__('Google Play')}}</button></a>
						</div>
						<div class="btns">
							<a href="javascript:void(0);" target="_blank"><button> <img src="{{asset('frontend')}}/images/applestore.png"> {{__('Apple Store')}}</button></a>
						</div>
					</div>
				</div>

				<!--add-post-ad-->
				<div class="add-post-ad">
					<div class="apa">
						<p>{{__('Do you have something to buy or Sell?')}}</p>
						<p>{{__('Post your ad on')}} kroykari.com</p>
						@if(auth::guest())
						<li class="is-not-loggedin" data-redirect="{{route('add.ad')}}"><a href="javascript:void()">{{__('Post your ad')}}</a></li>
						@else
						<li><a href="{{route('add.ad')}}">{{__('Post your ad')}}</a></li>
						@endif
					</div>
				</div>
				<!--end-->
			</div>
		</div>
	</section><!--end-->
@endsection