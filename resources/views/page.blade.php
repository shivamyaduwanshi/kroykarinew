@extends('layouts.app')
@section('content')

	<div class="navcigation padding-top">
		<div class="container">
			<ul>
				<li><a href="index.html">{{__('Home')}}</a></li>
				<li><a href="post_ad_form.html">{{ucfirst($page)}}</a></li>
			</ul>
		</div>
	</div>

	<!--post add-->
	<section class="post-ad-form">
		<div class="container">
		    @php print_r($content) @endphp
		</div>
	</section> <!--end-->

	<div class="google-ads google-ads2">
		<div class="container">
			<img src="{{asset('frontend')}}/images/ad3.jpg" alt="google ad" class="img-fluid">
		</div>
	</div>
@endsection