@extends('layouts.app')
 @section('content')
	<!--header-slider-->
	<section class="header-slider">
		<div class="container-fluid">
			<div class="slider-txt">
				<div class="slider-body">
					<div class="owl-carousel">
						<img class="owl-lazy" data-src="{{asset('public/frontend')}}/images/01.jpg" alt="slider Image">
						<img class="owl-lazy" data-src="{{asset('public/frontend')}}/images/01.jpg" alt="slider Image">
						<img class="owl-lazy" data-src="{{asset('public/frontend')}}/images/01.jpg" alt="slider Image">
					</div>
				</div>

				<div class="searchbar-txt">
					<h2>Welcome to Bikroykari.com The Largest
						Marketplace  in Bangladesh </h2>
					<div class="searchbar">
						<div class="inner">
							<i class="fas fa-search"></i>
							<input type="text" placeholder="Search here" name="" id="">
							<button><a style="color: #fff;" href="product_list.html">Search</a></button>
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
							<div class="single-box clearfix">
								<div class="img">
									<img src="{{asset('public/frontend')}}/images/icon1.png">
								</div>
								<div class="txt">
									<h2>Create an Account</h2>
									<p>Publishing and graphic design, Lorem ipsumis a placeholder text n publishing...</p>
								</div>
							</div>
						</div>
						<!--end-->
	
						<!--single process-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="single-box clearfix">
								<div class="img">
									<img src="{{asset('public/frontend')}}/images/icon2.png">
								</div>
								<div class="txt">
									<h2>Submit Your Ad</h2>
									<p>Publishing and graphic design, Lorem ipsumis a placeholder text n publishing...</p>
								</div>
							</div>
						</div>
						<!--end-->
	
						<!--single process-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="single-box clearfix">
								<div class="img">
									<img src="{{asset('public/frontend')}}/images/icon3.png">
								</div>
								<div class="txt">
									<h2>Make a Deal</h2>
									<p>Publishing and graphic design, Lorem ipsumis a placeholder text n publishing...</p>
								</div>
							</div>
						</div>
						<!--end-->
						
					</div>
				</div>
			</div><!--end-->

			<!--heading-->
			<div class="heading">
				<h2>{{__('Browse By Categor')}}y</h2>
				<p>What is Lorem Ipsum Lorem Ipsum is simply dummy text of the pri</p>
			</div> <!--end-->

			<!--browse by catergory-->
			<div class="browse-category">
				<div class="row">
					<!--categories-->
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="categories-box">
							<div class="row">
								@forelse($data['categories'] as $key => $category)
								<!--single category-->
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="single-category">
										<a href="product_list.html">
											<img src="{{$category->image}}" alt="{{$category->title}}">
											<div class="txt">
												<h2>{{$category->title}}</h2>
												<span>100+{{__('Available')}}</span>
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
								@forelse($data['cities'] as $key => $city)
								   @if($city->type == 'city')
  								    <li><a href="javascript:void(0);">{{$city->title}}</a></li>
  								   @endif
			                    @empty
			                    @endforelse
							</ul>
						</div>

						<div class="filter-links">
							<h2>{{__('cities')}}</h2>
							<ul>
  								@forelse($data['cities'] as $key => $city)
								   @if($city->type == 'division')
								      <li><a href="javascript:void(0);">{{$city->title}}</a></li>
								   @endif
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
				<h2>Top Ads</h2>
				<p>What is Lorem Ipsum Lorem Ipsum is simply dummy text of the pri</p>
			</div> <!--end-->

			<div class="row">
				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="ads-list">
						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<img class="featured-tag" src="{{asset('public/frontend')}}/images/featured.png" alt="">

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/02.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>LG Washing Machine Premium</h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="sale tag">Sale</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$150.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/03.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>People in lockdown told not to make impulsive </h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="rent tag">Rent</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$200.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<img class="featured-tag" src="{{asset('public/frontend')}}/images/featured.png" alt="">

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/02.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>LG Washing Machine Premium</h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="sale tag">Sale</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$150.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/03.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>People in lockdown told not to make impulsive </h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="rent tag">Rent</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$200.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<img class="featured-tag" src="{{asset('public/frontend')}}/images/featured.png" alt="">

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/02.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>LG Washing Machine Premium</h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="sale tag">Sale</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$150.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/03.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>People in lockdown told not to make impulsive </h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="sale tag">Sale</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$200.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->

						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart">
									<span><i class="fa fa-heart"></i></span>
								</label>
							</button>

							<a href="ad_details.html">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{asset('public/frontend')}}/images/02.jpg" alt="ads image">
									</div>
									
									<div class="txt">
										<h2>People in lockdown told not to make impulsive </h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>Location:</span>
												Indore(M.P.)
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>Category:</span>
												Household
												<label class="rent tag">Rent</label>
											</h3>
										</div>

										<p>Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod Lorem ipsum dolor sconsectetur adipiscing elit, sed do eiusmod..</p>

										<label class="price">$200.00</label>
									</div>
								</div>
							</a>
						</div><!--end-->
						
					</div>

					<!--pagination-->
					<div class="ads-pagination">
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
					</div>
					<!--end-->
				</div>

				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="google-ads">
						<img src="{{asset('public/frontend')}}/images/ad.jpg" alt="google ads" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</section><!--end-->

	<!--download app-->
	<section class="download-app">
		<div class="container">
			<div class="body clearfix">
				<div class="mobile"><img src="{{asset('public/frontend')}}/images/mobile.png"></div>
				<div class="txt-btn">
					<div class="heading">
						<h2>Download Our App</h2>
						<p>What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the What is Lorem Ipsum Lorem  </p>
					</div>
	
					<div class="download-btn">
						<div class="btns">
							<a href="javascript:void(0);"><button> <img src="{{asset('public/frontend')}}/images/playstore.png"> Google Play</button></a>
						</div>
						<div class="btns">
							<a href="javascript:void(0);"><button> <img src="{{asset('public/frontend')}}/images/applestore.png"> Apple Store</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!--end-->
	@endsection