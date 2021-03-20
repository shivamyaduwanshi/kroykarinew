	<!--footer-->

	@php 

	  $config = \DB::table('config')->select('key','value')->get();
      
      foreach ($config as $key => $con) {
			
			 if($con->key == 'facebook')
  			  $facebook = $con->value;
			
			 if($con->key == 'instagram')
			  $instagram = $con->value;
			
			 if($con->key == 'youtube')
			  $youtube = $con->value;
			
			 if($con->key == 'twitter')
			  $twitter = $con->value;
			
			 if($con->key == 'how-to-sell-fast')
			  $howToSellFast = $con->key;
			
			 if($con->key == 'membership')
			  $membership = $con->key;
			
			 if($con->key == 'faq')
			  $faq = $con->key;
			
			 if($con->key == 'about-us')
			  $aboutUs = $con->key;
			
			 if($con->key == 'terms-and-conditions')
			  $termsAndConditions = $con->key;
			
			 if($con->key == 'privacy-policy')
			  $privacyPolicy = $con->key;

			 if($con->key == 'sitemap')
			  $sitemap = $con->key;

			if($con->key == 'careers')
			  $careers = $con->key;

			if($con->key == 'stay-safe-on-kroykari')
			  $staySafeOnBikroyKari = $con->key;

			if($con->key == 'promote-your-ad')
			  $promoteYourAd = $con->key;

			if($con->key == 'banner-advertising')
			  $bannerAdvertising = $con->key;

	  }

	@endphp

	<footer>
		<div class="footer">
			<div class="container">
				<div class="row">
	
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="single-footer">
							<a href="{{route('home')}}" class="logo"><img src="{{asset('public/frontend')}}/images/logo-gray.png"></a>
							<p>{{__('We are the Bangladesh favorite classifieds for buy & sell everything')}}  </p>

							<div class="connect-with-us">
								<h3>{{__('Connect with us')}}</h3>
								<a href="{{$facebook}}"><i class="fab fa-facebook-f"></i>{{__('Like us on Facebook')}}</a>
							</div>
						</div>
					</div>

					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="single-footer">
							<h2>{{__('Social')}}</h2>
							<ul>
								<li><a href="{{$facebook}}" target="_blank">{{__('Facebook')}}</a></li>
								<li><a href="{{$youtube}}" target="_blank">{{__('Youtube')}}</a></li>
								<li><a href="{{$instagram}}" target="_blank">{{__('Instagram')}}</a></li>
								<li><a href="{{$twitter}}" target="_blank">{{__('Twitter')}}</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="single-footer">
							<h2>{{__('Learn More')}}</h2>
							<ul>
								<li><a href="{{route('page',$howToSellFast)}}">{{__('How to sell fast')}}</a></li>
								<li><a href="{{route('page',$membership)}}"">{{__('Membership')}}</a></li>
								<li><a href="{{route('page',$bannerAdvertising)}}"">{{__('Banner Advertising')}}</a></li>
								<li><a href="{{route('page',$promoteYourAd)}}"">{{__('Promote your ad')}}</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="single-footer">
							<h2>{{__('Help & Support')}}</h2>
							<ul>
								<li><a href="{{route('page',$faq)}}">{{__('FAQ')}}</a></li>
								<li><a href="{{route('page',$staySafeOnBikroyKari)}}">{{__('Stay safe on kroyKari.com')}}</a></li>
								<li><a href="{{route('contactUs')}}">{{__('Contact us')}}</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="single-footer">
							<h2>{{__('About us')}}</h2>
							<ul>
								<li><a href="{{route('page',$aboutUs)}}"">{{__('About us')}}</a></li>
								<li><a href="{{route('page',$careers)}}"">{{__('Careers')}}</a></li>
								<li><a href="{{route('page',$termsAndConditions)}}"">{{__('Terms & Conditions')}}</a></li>
								<li><a href="{{route('page',$privacyPolicy)}}"">{{__('Privacy Policy')}}</a></li>
							</ul>
						</div>
					</div>	
				</div>
			</div>
		</div>

		<div class="copyright">
			<p>@kroykari.com 2020-2022, All Rights Reserved.</p>
		</div>
	</footer><!--end-->