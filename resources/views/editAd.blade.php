@extends('layouts.app')
@section('content')

	<div class="navcigation padding-top">
		<div class="container">
			<ul>
				<li><a href="{{route('home')}}">{{__('Home')}}</a></li>
				<li><a href="{{route('myAds')}}">{{__('My Ads')}}</a></li>
				<li><a href="javascript:void(0)">{{__('Edit Ad')}}</a></li>
			</ul>
		</div>
	</div>

	<!--post add-->
	<section class="post-ad-form">
		<div class="container">
			<div class="left-form-details">
				<div class="heading">
					<h2>{{__('Sell an item or service')}}</h2>
					<p>{{__('Provide more information about your item and upload good quality')}}</p>
				</div>

				<form action="{{route('adUpdate',$data['ad']->id)}}" method="post" id="create-ad-form" enctype="multipart/form-data">
				   	@csrf
				   	{{ method_field('PUT')}}
					<div class="body">
						<h2 class="heading">{{__('What is your listing based on?')}}</h2>
						<div class="two-row">
								
							<div class="input-details">
								<div class="form-group">
									<label>{{__('Title')}} *</label>
									<input type="text" class="form-control" name="title" value="{{$data['ad']->title}}" placeholder="{{__('Keep its short')}}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
									  <label>{{__('Email')}}</label>
									   <input type="text" class="form-control" value="{{auth::user()->email}}" readonly>
								    </div>
								</div>
							    <div class="col-md-6 col-sm-12">
									<div class="form-group">
									  <label>{{__('Phone')}}</label>
									   <input type="text" class="form-control" value="{{auth::user()->phone}}" readonly>
								    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>{{__('Category')}}*</label>
										<select name="category" class="form-control" disabled>
										<option value="">{{__('Choose Category')}}</option>
										@forelse($data['categories'] as $category)
										  	   <option @if($category->id == $data['ad']->category_id) selected @endif value="{{$category->id}}">@if(app()->getLocale() == 'bn') {{ $category->title_bn }} @else {{$category->title }} @endif</option>
										@empty
										@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>{{__('Sub Category')}}*</label>
										<select name="sub_category" class="form-control" disabled>
											@forelse($data['subCategories'] as $category)
										  	   <option @if($category->id == $data['ad']->sub_category_id) selected @endif value="{{$category->id}}">@if(app()->getLocale() == 'bn') {{ $category->title_bn }} @else {{$category->title }} @endif</option>
											@empty
											@endforelse
								        </select>
								     </div>
							    </div>
							</div>
							<div class="row">
								@foreach($data['fields'] as $field)
								     @php $field = (object) $field @endphp
									 @if($field->field_type == 'select')
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>{{ __($field->field_name) }}</label>
												<select name="field[{{ $field->field_id }}]" class="form-control">
													@forelse($field->options as $option_key =>  $option)
														@if($option_key == '0')
													       <option value="">{{__($field->field_name)}}</option>
														@endif
													    	<option @if($field->field_value == $option->option) selected  @endif value="{{$option->option}}">{{__($option->option)}}</option>
													@empty
													@endforelse
												</select>
											</div>
										</div>
								 	 @endif
									 @if($field->field_type == 'text')
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>{{ __($field->field_name) }}</label>
												<input type="text" name="field[{{$field->field_id}}]" value="{{$field->field_value}}" class="form-control"/>
											</div>
										</div>
									 @endif
									 @if($field->field_type == 'radio')
									 <div class="col-md-6 col-sm-6">
										 <div class="form-group">
											 <label>{{ __($field->field_name) }}</label>
											 @forelse($field->options as $option_key =>  $option)
										    	 <input type="radio" name="field[{{$field->field_id}}]" @if($option->option == $field->field_value) checked @endif value="{{$option->option}}"/>&nbsp;{{__($option->option)}}&nbsp;
											 @empty
											 @endforelse
										 </div>
									 </div>
									 @endif
									 @if($field->field_type == 'checkbox')
									 <div class="col-md-6 col-sm-6">
										 <div class="form-group">
											 <label>{{ __($field->field_name) }}</label>
											 @forelse($field->options as $option_key =>  $option)
										    	 <input type="checkbox" name="field[{{$field->field_id}}][]" @if(in_array(strtolower($option->option),json_decode(strtolower($field->field_value)))) checked @endif value="{{$option->option}}"/>&nbsp;{{__($option->option)}}&nbsp;
											 @empty
											 @endforelse
										 </div>
									 </div>
								     @endif
								@endforeach
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>{{__('City or Division')}}</label>
										<select name="city" class="form-control">
											  <option value="">{{__('Choose City')}}</option>
											@forelse($data['cities'] as $city)
											  <option @if($city->id == $data['ad']->city_id) selected @endif value="{{$city->id}}">@if(app()->getLocale() == 'bn') {{ $city->title_bn }} @else {{$city->title }} @endif</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>{{__('local area within')}} {{$data['ad']->city->title}}</label>
										<select name="local_area" class="form-control">
											<option value="">{{__('Choose Area')}}</option>
											@forelse($data['areas'] as $area)
											  <option @if($area->id == $data['ad']->city_area_id) selected @endif value="{{$area->id}}">@if(app()->getLocale() == 'bn') {{ $area->title_bn }} @else {{$area->title }} @endif</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
							</div>
						
								<div class="form-group">
									<label>{{__('Description')}}*</label>
									<textarea class="form-control" rows="4" name="description" placeholder="{{__('More Details.. More Intrested Buyers')}}">{{$data['ad']->description}}</textarea>
								</div>

								<div class="form-group">
									<label>{{__('Price')}}*</label>
									<input type="text" name="price" class="form-control" value="{{$data['ad']->price}}" placeholder="{{__('Product Price')}}">
								</div>

								<label><input type="checkbox" @if($data['ad']->is_deliver_to_buyer) checked @endif name="is_deliver_to_buyer" value="1">&nbsp;&nbsp;I can deliver to this item buyer</label>
								<br>
								<label><input type="checkbox" @if($data['ad']->is_negotiable) checked @endif  name="is_negotiable" value="1">&nbsp;&nbsp;{{ __('Negotiable') }}</label>
							</div>
					   </div>
							   <!--contact map-->
							   <div class="contact-map">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="map">
											<input type="hidden" name="lat" value="{{$data['ad']->lat}}"/>
											<input type="hidden" name="lng" value="{{$data['ad']->lng}}"/>
											<div id="us2" style="width: 100%; height: 200px;"></div>
										</div>
									</div>
	
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="contact">
											<h2>{{_('Contact details')}}</h2>
	
											<div class="c-form">
												<div class="form-group">
													<label>{{__('Name')}}</label>
													<p>{{Auth::user()->name}}</p>
												</div>
												<div class="form-group">
													<label>{{__('Email')}}</label>
													<p>{{Auth::user()->email}}</p>
												</div>
											</div>
	
											<div class="add-number">
												<h3>{{__('Add phone number')}}</h3>
												<div class="input-btn">
													<input type="text" name="phone_number" placeholder="{{__('Enter Phone Number')}}">
													<button class="btn-add-phone">{{__('Add')}}</button>
												</div>
	
												<ul class="phone-number-list">
													   @if($data['ad']->phone_numbers)
														 @foreach(unserialize($data['ad']->phone_numbers) as $key => $value)
														 <li>
															 <div class="input-btn">
																 <input type="text" name="phone_numbers[]" value="{{$value}}">
																 <button class="btn-remove-phone"><i class="fas fa-times"></i></button>
															 </div>
														 </li>
														 @endforeach
													   @endif
												</ul>
	
												<div class="form-check">
													<label class="form-check-label">
													  <input type="checkbox" @if($data['ad']->is_hide_phone_number == '1') checked @endif name="is_hide_phone_number" class="form-check-input" value="1" >{{__('Hide phone numbers')}}
													</label>
												  </div>
											</div>
										</div>
									</div>
								</div>
						   </div>
						   <!--end-->
						   
						   <div class="photo-info">
								<p>{{ __('Add Pictures upto 6')}} <i class="fas fa-info-circle" title="{{__('Images must be PNG or JPG format (Max 6 MB). Do not upload images with watermarks')}}"></i></p>
						   </div>

						   <!--upload photos-->
					   <div class="upload-images">

					     	@php
							   $totalImages = 6;
							   $preImages   = count($data['ad']->images);
							   $remaingImages = $totalImages - $preImages;
						   @endphp

						    @forelse($data['ad']->images as $image)
							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" accept="image/*" name="image[]" disabled>
										<button class="dlt-btn dtn-remove-image"><i class="fas fa-times"></i></button>
										<img src="{{ $image['name'] }}" alt="" >
										<input type="hidden" name="image_id[]" value="{{$image['id']}}"/>
									</div>
								</label>
							</div>
							<!--end-->
 						 @empty
						 @endforelse 
						  @if($remaingImages)
							 @for($i = 0 ; $i < $remaingImages ; $i++)
								<!--single-img-->
								<div class="single-img">
									<label>
										<div class="img">
										    <input type="file" accept="image/*" name="image[]">
										    <img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									    </div>
									</label>
								</div>
								<!--end-->
							 @endfor
						 @endif
					</div>
				   <!--end-->
				   
						 {{-- <div class="drop-choose-img">
							<div class="drag-upload-img"></div>
						</div> --}}
						<br/>
						<div class="add-btn p-0">
							<button type="submit">{{__('Update Ad')}}</button>
						</div>
				    </div>
			    </form>
			</div><!--right-->
		</div>
	</section> <!--end-->

	<div class="google-ads google-ads2">
		<div class="container">
			<img src="{{asset('frontend')}}/images/ad3.jpg" alt="google ad" class="img-fluid">
		</div>
	</div>
@endsection
@push('css')
 <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/image-uploader.min.css">
@endpush
@push('js')
 <script type="text/javascript" src="{{asset('/')}}js/image-uploader.min.js"></script>
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyA--ohqdRW1EpW4DSnxuYSycDObj_IItC0'></script>
 <script src="{{asset('/')}}js/locationpicker.jquery.min.js"></script>
 <script type="text/javascript">

    $(document).ready(function(){

		        var uploadImage = "{{asset('public/frontend/images/upload1.jpg')}}";

			    //Image Preview
		  	    $('body').on('change','input[type="file"]',function(e){
				   e.preventDefault();
					tmppath = URL.createObjectURL(event.target.files[0]);
				   $(this).parents('.img').find('img').attr('src',tmppath);
				   $(this).parents('.img').append('<button class="dlt-btn dtn-remove-image"><i class="fas fa-times"></i></button>');
				});

				$('body').on('click','.dtn-remove-image',function(e){
					e.preventDefault();
					$(this).parents('.img').find('input[type="file"]').val('');
					$(this).parents('.img').find('input[type="file"]').removeAttr('disabled');
					$(this).parents('.img').find('input[type="hidden"]').val('');
					$(this).parents('.img').find('img').attr("src",uploadImage); 
					$(this).remove();
				});

		let phoneNumbers = function(phoneNumber){
			   let html = '<li>';
			      html += '<div class="input-btn">';
						html += `<input type="text" name="phone_numbers[]" value="${phoneNumber}" readonly>`;
						html +=	'<button class="btn-remove-phone"><i class="fas fa-times"></i></button>';
				   html +=	'</div>';
				   html += '</li>';
				   $('.phone-number-list').append(html);
		}

		$('.btn-add-phone').on('click',function(e){
               e.preventDefault();
			   let phoneNumber = $('input[name="phone_number"]').val();
			   numbers = $('input[name="phone_number[]"]');
               if(phoneNumber){
 				  $('input[name="phone_number"]').val('');
   			      phoneNumbers(phoneNumber);
			   }
		});

		$('body').on('click','.btn-remove-phone',function(e){
               e.preventDefault();
			   $(this).parents('.input-btn').remove();
		});
        
		if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function(position){
			  let lat = "{{$data['ad']->lat}}";
			  let lng = "{{$data['ad']->lng}}";
			  if(lat == null || lat == '' || lat == 'null' || lng == null || lng == '' || lng == 'null'){
				  lat = position.coords.latitude;
				  lng = position.coords.longitude;
			  }
			  $('input[name="lat"]').val(lat);
			  $('input[name="lng"]').val(lng);
                $('#us2').locationpicker({
                    location: {latitude: lat, longitude: lng},
					onchanged: function(currentLocation, radius, isMarkerDropped) {
						$('input[name="lat"]').val(currentLocation.latitude);
						$('input[name="lng"]').val(currentLocation.longitude);
					},
                });
           });
        } else { 
           x.innerHTML = "Geolocation is not supported by this browser.";
        }

	});
       
 	    // Get SubCategories
  	    var getSubCategories = function(id,callBack){
					$.ajax(
					{
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'get',
						'url' : '{{url('ajax/sub/category')}}' + '/' + id,
					beforeSend: function() {

					},
					'success' : function(response){
                        callBack(response);
					},
  					'error' : function(error){
					},
					complete: function() {
					},
					});
  	    }

  	    // Get SubCategories
  	    var getLocalAreas = function(id,callBack){
					$.ajax(
					{
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'get',
						'url' : '{{url('ajax/city/area')}}' + '/' + id,
					beforeSend: function() {

					},
					'success' : function(response){
                        callBack(response);
					},
  					'error' : function(error){
					},
					complete: function() {
					},
					});
  	    }
   
	     $('select[name="category"]').on('change',function(e){
	     	  e.preventDefault();
	     	 getSubCategories(e.target.value,function(resnponse){
	     	 	 if(resnponse.status == 'success'){
	     	 	 	let option = '';
	     	 	 	    resnponse.data.map(function(subCategory,index){
	     	 	 	    	if(index == 0){
	                          option += '<option value="">{{__('Choose Sub-Category')}}</option>';
	     	 	 	    	}
	                        option += `<option value="${subCategory.id}">${subCategory.title}</option>`;
	     	 	 	    });
	     	 	 	   $('select[name="sub_category"]').html(option);
	     	 	 }

	     	 	 if(resnponse.status == 'failed'){
	     	 	 	
	     	 	 }
	     	 });
	     });

	     $('select[name="city"]').on('change',function(e){
	     	 e.preventDefault();
	     	 getLocalAreas(e.target.value,function(resnponse){
	     	 	console.log(resnponse);
	     	 	 if(resnponse.status == 'success'){
	     	 	 	let option = '';
	     	 	 	    resnponse.data.map(function(localArea,index){
	     	 	 	    	if(index == 0){
	                          option += '<option value="">{{__('Choose Local Area')}}</option>';
	     	 	 	    	}
	                        option += `<option value="${localArea.id}">${localArea.title}</option>`;
	     	 	 	    });
	     	 	 	   $('select[name="local_area"]').html(option);
	     	 	 }

	     	 	 if(resnponse.status == 'failed'){
	     	 	 	
	     	 	 }
	     	 });
	      });

	     //Create Form
	     $('#create-ad-form').on('submit',function(e){
	     	e.preventDefault();
				let form  = $(this);
	 		    let data  = new FormData(this);
				$.ajax({
					"headers":{
					'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
				},
					'type':'POST',
					'url' : form.attr('action'),
					'data' : data,
					cache : false,
					contentType : false,
					processData : false,
				beforeSend: function() {

				},
				'success' : function(response){
					  form.find('span.text-error').remove();
					if(response.status == 'success'){
	   			      toastr.success(response.message);
	   	 		      setTimeout(function(){ window.location.href="{{route('myAds')}}" }, 1000);
					}
					if(response.status == 'failed'){
					   toastr.error(response.message);
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
@endpush