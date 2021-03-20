@extends('layouts.app')
@section('content')
   @section('meta_tag')
		@php
			$ext = pathinfo(
			parse_url($data['ad']->image, PHP_URL_PATH), 
			PATHINFO_EXTENSION
			);
		@endphp
		<meta property='og:image' content='{{$data['ad']->image}}'/>
		<meta property="og:image:type" content="image/{{$ext}}" />
		<meta property="og:image:width" content="400" />
		<meta property="og:image:height" content="300" />
		<meta property="og:image:alt" content="banner" />
		<meta property="og:url"           content="{{route('adShow',[$data['ad']->id,urlencode($data['ad']->title)])}}" />
		<meta property="og:type"          content="{{$data['ad']->title}}" />
		<meta property="og:title"         content="{{$data['ad']->title}}" />
		<meta property="og:description"   content="{{$data['ad']->description}}" />
		<link rel="image_src" href="{{$data['ad']->image}}" />
   @endsection
	<!--ad details-->
	<section class="product-details">
		<div class="container">
			<div class="navcigation">
				<ul>
					<li><a href="index.html">{{__('Home')}}</a></li>
					<li><a href="ad_details.html">{{__('Details')}}</a></li>
				</ul>
			</div>

			<div class="details-box">
				<div class="row">
					<!--left-->
					<div class="col-md-8 col-sm-12 col-xs-12">

						<!--product-slider-->
						<div class="product-slider pictures-viewers">
							<div class="owl-carousel">
								@forelse($data['ad']->images as $img)
								  <img class="owl-lazy" data-original="{{$img['name']}}" data-src="{{$img['name']}}" alt="{{$data['ad']->title}}">
								@empty
								@endforelse
							</div>
						</div>
						<!--end-->

						<!--text details-->
						<div class="text-details">
							<div class="heading">
								<h2>{{__('Details')}}</h2>
							</div>
							<div class="body">
								     <div class="car-details clearfix">
									  @foreach ($data['fields'] as $field )
									    @if($field->field_type != 'checkbox')
									    	<p>{{__($field->field_name)}}: <span>{{$field->field_type != 'text' ? __($field->value) : __($field->value) }}</span></p>
										@else
											@php
											    $str = '';
												if($field->value){
													foreach(json_decode($field->value) as $value){
														$str .= __($value) . ',';
													}
												}
											 @endphp
									    	<p>{{__($field->field_name)}}: <span> {{ substr($str, 0, -1) }}</span></p>
 									    @endif
										@endforeach
								  	 </div>
										<div class="description">
									<h2>{{__('Description')}}</h2>
									<pre><p><?php echo $data['ad']->description ;?></p></pre>
								</div>
							</div>
						</div>
						<!--end-->


						<!--recent ads-->
						<div class="ads-list">
							<div class="heading">
								<h2>{{__('Similar Ads')}}</h2>
							</div>
                           
                           @forelse($data['ads'] as $ad)
							<!--single-ads-->
							<div class="single-ads">
						 		<button class="like-btn">
									<label>
										<input type="checkbox" @if($ad->is_like)  checked  @endif name="heart">
										<span><i class="fa fa-heart like-ad" data-id="{{$data['ad']->id}}"></i></span>
									</label>
								</button>
	
								<img class="featured-tag" src="{{asset("frontend")}}/images/featured.png" alt="">
	
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
													{{$ad->area->title_name ?? ''}}&nbsp;({{$ad->city->title_name ?? ''}})
												</h3>
												<h3>
													<i class="fa fa-briefcase"></i>
													<span>{{__('Category')}}:</span>
													{{$ad->category->title_name ?? ''}}
													<label class="sale tag">{{$ad->subCategory->title_name ?? ''}}</label>
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
							
						</div><!--end-->

					</div>
					<!--end-->

					<!--right-->
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="right-details">
							<!--text-mamp-->
							<div class="price-name-add">
								<div class="header">
									<h2>৳ {{$data['ad']->price}}</h2>
									<h3>{{$data['ad']->title}}</h3>

									<div class="social-share-box">
									  <button class="share social-share">
									    <i class="fas fa-share-alt"></i>

									    <div class="share-options">
									      <ul>
									        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(route('adShow',[$data['ad']->id,$data['ad']->title]))}}"><i class="fab fa-facebook"></i> Facebook</a></li>
 									        <li><a target="_blank" href="http://www.twitter.com/share?url={{route('adShow',[$data['ad']->id,urlencode($data['ad']->title)])}}"><i class="fab fa-twitter"></i> Twitter</a></li>
									        <li><a target="_blank" href="https://wa.me/?text={{route('adShow',[$data['ad']->id,urldecode($data['ad']->title)])}}"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
									      </ul>
									    </div>
									  </button>
									</div>

									<button class="like-btn">
										<label>
											<input type="checkbox" @if($data['is_liked']) checked @endif>
											<span><i class="fa fa-heart like-ad" data-id="{{$data['ad']->id}}"></i></span>
										</label>
									</button>
								</div>
								<div class="body mb-2">
									<p><i class="fas fa-map-marker-alt"></i> {{$data['ad']->area->title_name}}&nbsp;({{$data['ad']->city->title_name}})</p>
								</div>
								<div class="date-view clearfix">
									<span class="date"><i class="far fa-clock"></i> {{$data['ad']->created_at->diffForHumans()}}</span>
								</div>
								@if($data['ad']->is_deliver_to_buyer)
									<div class="date-view clearfix">
										<span class="text-default"><i class="fas fa-truck"></i>&nbsp;{{__('Deliver this item to buyer')}}</span>
									</div>
								@endif
								@if($data['ad']->is_negotiable)
								<div class="date-view clearfix">
									<span class="text-default"><i class="fas fa-tint"></i>&nbsp;&nbsp;{{__('Negotiable')}}</span>
								</div>
							@endif
							</div>
							<!--end-->

							<!--google-ads-->
							<div class="google-ads">
								<img src="{{asset("frontend")}}/images/ad1.jpg" alt="google ads" class="img-fluid">
							</div><!--end-->

							<!--about seller-->
							<div class="about-seller">
								<div class="header">
									<h2>{{__('About Seller')}}</h2>
								</div>

								<div class="profile">
									<a href="javascript:void(0);" class="clearfix">
										<div class="img">
											<img onerror="profileImgError(this);" src="{{ucfirst($data['ad']->user->profile_image)}}">
										</div>
	
										<div class="txt">
											<h2>{{ucfirst($data['ad']->user->name)}} <i class="fas fa-chevron-right"></i></h2>
											<p>{{__('Member Sience')}} {{date('Y-M-d',strtotime($data['ad']->user->created_at))}}</p>
										</div>
									</a>
								</div>

								<div class="btns">
									@if(auth::guest())
									<a href="{{route('login')}}" class="chat">{{__('Chat WIth Seller')}}</a>
									@else
										@if($data['ad']->user_id != auth::id())
										   @php
										      $chatRoomId = $data['ad']->id . '-';
											  $tempArr = [auth::id(),$data['ad']->user_id];
											  $chatRoomId  .= min($tempArr) . '-';
											  $chatRoomId  .= max($tempArr);
										   @endphp
										  <a href="{{route('chat',['chatroomid'=>$chatRoomId])}}" class="chat">{{__('Chat WIth Seller')}}</a>
										@endif
									@endif
									 @if($data['ad']->is_hide_phone_number != '1')
									     @if($data['ad']->phone_numbers)
											@foreach(unserialize($data['ad']->phone_numbers) as $key => $value)
											   <a href="tel:+880{{$value}}" class="call">{{__('Call')}}: +880 {{$value}}</a>
											@endforeach
										 @endif
								     @endif
								</div>

								<div class="id-report clearfix">
									<p class="id">{{__('Item Id')}}: <span>#{{$data['ad']->id}}</span></p>
									@if(auth::guest())
								    	<a href="{{route('login')}}"><p class="report" id="report-modal-btn"><i class="fas fa-flag"></i> {{__('Report Item')}}</p></a>
									@else
									    <p class="report" id="report-modal-btn"><i class="fas fa-flag"></i> {{__('Report Item')}}</p>
									@endif
								</div>

							</div>
							<!--end-->
								
							   @if($data['ad']->lat != null && $data['ad']->lng != null)
									<!-- Map Location --> 
									<div class="about-seller">
										<div class="header">
											<h2>{{__('Map Location')}}</h2>
										</div>
										<div id="us2" style="width: 100%; height: 200px;"></div>
									</div>
									<!--end-->
								@endif

							<!--google-ads-->
							<div class="google-ads">
								<img src="{{asset("frontend")}}/images/ad2.jpg" alt="google ads" class="img-fluid">
							</div><!--end-->

						</div>
					</div>
					<!--end-->
				</div>
				
			</div>
		</div>
    </section> <!--end-->

		<div class="modal fade report-modal custom-modal" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		 <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Report Ad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="{{ route('report.ad') }}" method="POST" id="report-form">
					@csrf
					<input type="hidden" name="ad_id" value="{{$data['ad']->id}}"/>
					<div class="modal-body">
						<div class="report-type">
							<ul>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="pr1" name="type" value="Offensive content">
										<label class="custom-control-label" for="pr1">Offensive content</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="pr2" name="type" value="Fraud">
										<label class="custom-control-label" for="pr2">Fraud</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="pr3" name="type" value="Duplicate">
										<label class="custom-control-label" for="pr3">Duplicate ad</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="pr4" name="type" value="Product Already Sold">
										<label class="custom-control-label" for="pr4">Product already sold</label>
									</div>
								</li>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="pr6" name="type" value="Other" checked>
										<label class="custom-control-label" for="pr6">Other</label>
									</div>
								</li>
							</ul>
						</div>
						<div class="form-group">
							<textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Comment" required></textarea>
						</div>
						<div class="buttons">
							<button type="submit">Send Complaint</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection
@push('css')
 <style>
	 .report-type{
    margin: 0 0 20px;
  }
.report-type ul{
    display: block;
    padding: 0;
    margin: 0;
    list-style: none;
}
.report-type ul li{
    margin: 0 0 5px;
}
.report-modal .buttons button {
    background: #f6503f;
    color: #fff;
    font-size: 15px;
    border-radius: 4px;
    border: 0;
    height: 45px;
    width: 100%;
    font-weight: 600;
}
.report-modal .form-group{
    margin: 0 0 20px;
}
.report-modal .form-control{
    box-shadow: none;
    padding: 10px;
    font-size: 14px;
    color: #000;
}
.custom-modal .modal-title {
    color: #fff;
}
.report-type ul li label {
    color: #000;
    font-size: 15px;
    cursor: pointer;
}
.product-details .details-box .right-details .text-mamp .report label{
    color: #878787;
    font-size: 13px;
    margin: 0;
    cursor: pointer;
}
 </style>
@endpush
@push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyA--ohqdRW1EpW4DSnxuYSycDObj_IItC0'></script>
<script src="{{asset('/')}}js/locationpicker.jquery.min.js"></script>
  <script>



     $(document).ready(function(){
 		 var  lat = "{{ $data['ad']->lat }}";
  	     var  lng = "{{ $data['ad']->lng }}";
		  
		if (navigator.geolocation) {
				 @if($data['ad']->lat != null && $data['ad']->lng != null)
					 $('#us2').locationpicker({
						    location: {latitude: lat, longitude: lng},
							markerIcon: undefined,
							markerDraggable: false,
							markerVisible : true,
							draggable: false,
							radius: 500,
							zoom: 12,
					 });
			     @endif
        } else { 
           x.innerHTML = "Geolocation is not supported by this browser.";
        }
	 });

	   $('#report-modal-btn').on('click',function(e){
		   console.log('Hello');
     	   $('#report-modal').modal('show');
	   })
	   $('#report-form').on('submit',function(e){
		     e.preventDefault();
                var click = $(this);
                let form  = $(this);
                let data = form.serialize();
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
                    click.find('span.invalid-feedback').remove();
                    click.find('#comment').val('');
                    if(response.status == 'success'){
                    	  $('#report-modal').modal('hide');
                          toastr.success(response.message);
                    }
                    if(response.status == 'failed'){
                         toastr.error(response.message);
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
    <script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
		fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));</script>
@endpush