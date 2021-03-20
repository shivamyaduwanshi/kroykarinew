@extends('layouts.app')
@section('content')

@php
$satetyNotification = '';
$config = \DB::table('config')->select('key','value','lang')->where('key','safety-notification')->get();
foreach ($config as $key => $con) {
	   if($con->lang == app()->getLocale())
		  $satetyNotification = $con->value;
}
@endphp

	<div class="navcigation padding-top">
		<div class="container">
			<ul>
				<li><a href="{{route('home')}}">{{__('Home')}}</a></li>
				<li><a href="javascript:void(0)">{{__('Ad Post Form')}}</a></li>
			</ul>
		</div>
	</div>

	<!--post add-->
	<section class="post-ad-form">
		<div class="container">
			<div class="left-form-details">
				<div class="heading">
					<h2>{{__('Sell an item or service')}} 
						<span id="locationModalOpenBtn"><i class="fas fa-map-marker-alt" style="color:#142a5b"></i> <small class="location-text"></small></span> <span id="categoryModalOpenBtn"><i class="fas fa-tags"  style="color:#142a5b"></i> <small class="category-text"></small></span>
					</h2>
					<p>{{__('Provide more information about your item and upload good quality')}}</p>
				</div>

				 <form action="{{route('ad.store')}}" method="post" id="create-ad-form" enctype="multipart/form-data">
					   @csrf
					   <input type="hidden" name="is_agree" value=""/>
					   <input type="hidden" name="category" value="" />
					   <input type="hidden" name="sub_category" value="" />
					   <input type="hidden" name="city" value="" />
					   <input type="hidden" name="local_area" value="" />
					<div class="body">
						<h2 class="heading">{{__('What is your listing based on?')}}</h2>
						<div class="two-row">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="input-details">
										<div class="form-group">
											<label>{{__('Title')}} *</label>
											<input type="text" class="form-control" name="title" placeholder="{{__('Keep its short')}}">
										</div>
									</div>
						    	</div>
							</div>
                              <div class="row dynamic-fields"></div>
						  	  <div class="input-details">

								<div class="form-group">
									<label>{{__('Description')}}*</label>
									<textarea class="form-control" rows="4" name="description" placeholder="{{__('More Details.. More Intrested Buyers')}}"></textarea>
								</div>

								<div class="form-group">
									<label>{{__('Price')}}(TK)*</label>
									<input type="text" name="price" class="form-control" placeholder="{{__('Product Price')}}">
								</div>
								<label><input type="checkbox"  name="is_deliver_to_buyer" value="1">&nbsp;&nbsp;{{__('I can deliver to this item buyer')}}</label>
								<br>
								<label><input type="checkbox"  name="is_negotiable" value="1">&nbsp;&nbsp;{{ __('Negotiable') }}</label>
							</div>
					   </div>
					   <input type="hidden" name="lat"  value="" />
					   <input type="hidden" name="lng" value="" />
					   
					   <!--contact map-->
					   <div class="contact-map">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="map">
										<div id="us2" style="width: 100%; height: 200px;"></div>
									</div>
								</div>

								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="contact">
										<h2>Contact details</h2>

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
											</ul>

											<div class="form-check">
												<label class="form-check-label">
												  <input type="checkbox" name="is_hide_phone_number" class="form-check-input" value="1" >{{__('Hide phone numbers')}}
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
						
							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" accept="image/*" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->
							
							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" accept="image/*" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->

							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->

							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->

							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->

							<!--single-img-->
							<div class="single-img">
								<label>
									<div class="img">
										<input type="file" name="image[]" >
										<img src="{{asset('public/frontend')}}/images/upload1.jpg" alt="">
									</div>
								</label>
							</div>
							<!--end-->
						</div>
					   <!--end-->
					   
						 {{-- <div class="drop-choose-img">
							<div class="drag-upload-img"></div>
						</div> --}}
						<div class="add-btn p-0">
							<button id="submit-form" type="submit">{{__('Post Ad')}}</button>
						</div>
				    </div>
			    </form>
			</div><!--right-->
		</div>

		    <!-- The Modal -->
			<div class="modal fade custom-modal posting-allowance-modal posting-tc-modal" id="posting-safety-modal">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
						<!-- Modal Header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						
						<!-- Modal body -->
						<div class="modal-body">
							<div class="text">
								<div class="logo">
									<img src="{{asset('public/frontend')}}/images/logo.png" alt="">
								</div>
								<h3>{{__('Safety First!')}}</h3>
								{{-- <div class="heading">
									<h2>{{__('All ads posted on kroykari.com must follow our rules')}}:</h2>
								</div> --}}
								<div class="content-line">
									@php echo $satetyNotification @endphp
								</div>

								<div class="form-more-info">
									<p>{{__('For more information, read our')}}</p>
									<a target="_blank" href="{{route('page','terms-and-conditions')}}">{{__('terms and condition')}}</a>
								</div>
                               <div class="buttons">
								<button class="yes-agree">{{__('Yes, I agree!')}}</button>
							   </div>
							</div>
						</div>                
					</div>
				</div>
			</div><!--end-->
	</section> <!--end-->
	<div class="google-ads google-ads2">
		<div class="container">
			<img src="{{asset('frontend')}}/images/ad3.jpg" alt="google ad" class="img-fluid">
		</div>
	</div>

  	  <div class="modal fade report-modal custom-modal" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		   <div class="modal-content">
			   <div class="modal-header">
				   <h5 class="modal-title" id="locationModalLabel">{{__('Select Location')}}</h5>
				   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				   <span aria-hidden="true">×</span>
				   </button>
			   </div>
			   <div class="modal-body">
					<div class="post-ad-options">
						<div class="row">
							<div class="col-md-6 padding-0 leftside-list">
							</div>
							<div class="col-md-6 padding-0 rightside-list">
							</div>
						</div>
					</div>
				</div>
		   </div>
	   </div>
	</div>

	   <div class="modal fade report-modal custom-modal" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		   <div class="modal-content">
			   <div class="modal-header">
				   <h5 class="modal-title" id="categoryModalLabel">{{__('Select Category')}}</h5>
				   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				   <span aria-hidden="true">×</span>
				   </button>
			   </div>
			   <div class="modal-body">
					<div class="post-ad-options">
						<div class="row">
							<div class="col-md-6 padding-0 leftside-list">
							</div>
							<div class="col-md-6 padding-0 rightside-list">
							</div>
						</div>
					</div>
				</div>
		   </div>
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
			   $('input[name="phone_number"]').val('');
			   numbers = $('input[name="phone_number[]"]');
               if(phoneNumber){
   			      phoneNumbers(phoneNumber);
			   }
		});

		$('body').on('click','.btn-remove-phone',function(e){
               e.preventDefault();
			   $(this).parents('.input-btn').remove();
		});
        
		$('#locationModalOpenBtn').on('click',function(){
   	   	   $('#locationModal').modal('show');
		});

		$('#categoryModalOpenBtn').on('click',function(){
			$('#categoryModal').modal('show');
		});
        
		if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function(position){
              lat = position.coords.latitude;
			  lng = position.coords.longitude;
			  $('input[name="lat"]').val(lat);
			  $('input[name="lng"]').val(lng);
                $('#us2').locationpicker({
                    location: {latitude: lat, longitude: lng},
					onchanged: function(currentLocation, radius, isMarkerDropped) {
						$('input[name="lat"]').val(currentLocation.latitude);
						$('input[name="lng"]').val(currentLocation.longitude);
					},
                });
           },function(error){
			    if(error.code){
                    $('#us2').hide();
				}
		   });
        } else { 
			alert('Hello Shi!');
           x.innerHTML = "Geolocation is not supported by this browser.";
        }

	});

      var lang = "{{app::getLocale()}}";

		$('.yes-agree').on('click',function(){
				$('input[name="is_agree"]').val('1');
				$('#posting-safety-modal').modal('hide');
				$('#submit-form').submit();
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
	     var getFormFields = function(id,callBack){
					$.ajax(
					{
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'get',
						'url' : '{{url('api/get/form/field')}}' + '?lang='+lang+'&category_id=' + id,
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
                        option += `<option value="${subCategory.id}">${subCategory.title_name}</option>`;
     	 	 	    });
     	 	 	   $('select[name="sub_category"]').html(option);
     	 	 }

     	 	 if(resnponse.status == 'failed'){
     	 	 	
     	 	 }
     	 });
     });

	const dynamicFormField = function(fields){
		
		$('.dynamic-fields').html('');

		 fields.map(function(field,index){
                // Select Input field
				if(field.field_type == 'select'){
					let TextField  = '<div class="col-md-6 col-sm-6">';
						TextField += 	'<div class="form-group">';
						TextField += 	`<label>Select ${field.field_name}</label>`;
						TextField += 	 `<select name="field[${field.field_id}]" class="form-control">`;
						field.options.map(function(option,index){
						TextField +=      `<option value="${option.option}">${option.label}</option>`;
						});
						TextField +=     '</select>';
						TextField +=  	'</div>';
						TextField +=   '</div>';
						$('.dynamic-fields').append(TextField);
				}
                // Text Input field
				if(field.field_type == 'text'){
					let TextField  = '<div class="col-md-6 col-sm-6">';
						TextField += 	'<div class="form-group">';
						TextField += 	  `<label>${field.field_name}</label>`;
						TextField += 	  `<input type="text" name="field[${field.field_id}]" value="" class="form-control"/>&nbsp;&nbsp;`;
						TextField +=  	'</div>';
						TextField += '</div>';
						$('.dynamic-fields').append(TextField);
				}
                // Radio Input field
				if(field.field_type == 'radio'){
					let TextField  = '<div class="col-md-6 col-sm-6">';
						TextField += 	'<div class="form-group">';
						TextField += 	  `<label>${field.field_name}</label>`;
						field.options.map(function(option,index){
						TextField +=      `<input type="radio" name="field[${field.field_id}]" value="${option.option}" /> ${option.label}&nbsp;&nbsp;`;
						});
						TextField +=  	'</div>';
						TextField += '</div>';
						$('.dynamic-fields').append(TextField);

				}
				// Checkbox Input field
				if(field.field_type == 'checkbox'){
					let TextField  = '<div class="col-md-6 col-sm-6">';
						TextField += 	'<div class="form-group">';
						TextField += 	  `<label>${field.field_name}</label>`;
						field.options.map(function(option,index){
						TextField +=      `<input type="checkbox" name="field[${field.field_id}][]" value="${option.option}" /> ${option.label}&nbsp;&nbsp;`;
						});
						TextField +=  	'</div>';
						TextField += '</div>';
						$('.dynamic-fields').append(TextField);
				}
		 });
	}

	 if(localStorage.getItem('sub_category') != null){
		getFormFields(localStorage.getItem('sub_category'),function(resnponse){
     	 	 if(resnponse.status == true){
				dynamicFormField(resnponse.data);
     	 	 }
     	 });
	 }

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

				if(response.status == 'warning'){
                     $('#posting-safety-modal').modal('show');
				}

				if(response.status == 'success'){
   			      toastr.success(response.message);
   	 		      setTimeout(function(){ window.location.href="{{route('myAds')}}" }, 1000);
				}
				if(response.status == 'failed'){
  			       $('input[name="is_agree"]').val('0');
				   toastr.error(response.message);
				}
				if(response.status == 'error'){
					$('input[name="is_agree"]').val('0');
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

	 if(localStorage.getItem('category') == null || localStorage.getItem('sub_category') == null || localStorage.getItem('city') == null || localStorage.getItem('area') == null){
          window.location.href = "{{route('add.ad')}}";
	 }else{
		 $('input[name="category"]').val(localStorage.getItem('category'));
		 $('input[name="sub_category"]').val(localStorage.getItem('sub_category'));
		 $('input[name="city"]').val(localStorage.getItem('city'));
		 $('input[name="local_area"]').val(localStorage.getItem('area'));
		 $('.location-text').text(localStorage.getItem('area_name'));
		 $('.category-text').text(localStorage.getItem('category_name'));
	 }

 </script>
  <script>

				//Image Preview
				$('body').on('change','input[type="file"]',function(e){
					e.preventDefault();
					tmppath = URL.createObjectURL(event.target.files[0]);
				   $(this).parents('.img').find('img').attr('src',tmppath);
				   $(this).parents('.img').append('<button class="dlt-btn dtn-remove-image"><i class="fas fa-times"></i></button>');
				});

				var uploadImage = "{{asset('public/frontend/images/upload1.jpg')}}";

				$('body').on('click','.dtn-remove-image',function(e){
					e.preventDefault();
					$(this).parents('.img').find('input[type="file"]').val('');
					$(this).parents('.img').find('img').attr("src",uploadImage);
					$(this).remove();
				});

				let category = (category,selectedId=null) => {
				let html   = '<ul>';
					category.map(function(item,index){
						if(selectedId == item.id){
							html += '<li class="main-category active" data-id="'+item.id+'" data-name="'+item.title+'">';
						}else{
							html += '<li class="main-category" data-id="'+item.id+'" data-name="'+item.title+'">';
						}
						html +=   '<div class="leading">';
						html +=     '<div class="icon"><img src="'+item.image+'"></div>';
						html +=      '<div class="title">'+item.title+'</div>';
						html +=   '</div>'
						html += '</li>';
					});
					html += '</ul>';
				return html;
				}
	    
				let subCategory = (subCategory,selectedId=null) => {
				let html   = '<ul>';
					subCategory.map(function(item,index){
						if(selectedId == item.id){
							html += '<li class="sub-category active" data-id="'+item.id+'" data-name="'+item.title+'">';
						}else{
							html += '<li class="sub-category" data-id="'+item.id+'" data-name="'+item.title+'">';
						}
						html +=   '<div class="leading">';
						html +=     '<div class="icon"><img src="'+item.image+'"></div>';
						html +=      '<div class="title">'+item.title+'</div>';
						html +=   '</div>'
						html += '</li>';
					});
					html += '</ul>';
				return html;
				}

				let city = (city,selectedId=null) => {
					let html   = '<ul>';
						city.map(function(item,index){
							if(selectedId == item.id){
  						       html += '<li class="city active" data-id="'+item.id+'" data-name="'+item.title+'">';
							}else{
								html += '<li class="city" data-id="'+item.id+'" data-name="'+item.title+'">';
							}
						html +=   '<div class="leading">';
						html +=      '<div class="title">'+item.title+'</div>';
						html +=   '</div>'
						html +=   '<div class="trailing"><i class="fas fa-angle-right"></i></div>';
						html += '</li>';
					});
					html += '</ul>';
				return html;
				}

				let area = (area,selectedId=null) => {
				let html   = '<ul>';
						area.map(function(item,index){
						if(selectedId == item.id){
							html += '<li class="area active" data-id="'+item.id+'" data-name="'+item.title+'">';
						}else{
							html += '<li class="area" data-id="'+item.id+'" data-name="'+item.title+'">';
						}
						html +=   '<div class="leading">';
						html +=     '<div class="icon"><img src="'+item.image+'"></div>';
						html +=      '<div class="title">'+item.title+'</div>';
						html +=   '</div>'
						html += '</li>';
					});
					html += '</ul>';
				return html;
				}

			//Get Location
			$('body').on('click','#locationModalOpenBtn',function(e){
					e.preventDefault();

					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'GET',
						'url' : "{{route('ajax.city')}}",
					beforeSend: function() {

					},
					'success' : function(response){
						let html = '';
						if(response.status == 'success'){
							if(response.data.length > 0)
								html += city(response.data,localStorage.getItem('city'));
						}
						if(response.status == 'failed'){
						}
						if(response.status == 'error'){
						}
						$('#locationModal .leftside-list').html(html);
					},
					'error' : function(error){
						console.log(error);
					},
					complete: function() {

					},
					});

					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'GET',
						'url' : "{{route('ajax.city.area')}}" + '/' + localStorage.getItem('city'),
					beforeSend: function() {

					},
					'success' : function(response){
						let html = '';
						if(response.status == 'success'){
							if(response.data.length > 0)
								html += area(response.data,localStorage.getItem('area'));
						}
						if(response.status == 'failed'){
						}
						if(response.status == 'error'){
						}
						$('#locationModal .rightside-list').html(html);
					},
					'error' : function(error){
						console.log(error);
					},
					complete: function() {

					},
					});

			});

			//Get Category
			$('body').on('click','#categoryModalOpenBtn',function(e){
					e.preventDefault();

					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
					'type':'GET',
					'url' : "{{route('ajax.category')}}",
					 beforeSend: function() {

					 },
					'success' : function(response){
					let html = '';
					if(response.status == 'success'){
					if(response.data.length > 0)
					html += category(response.data,localStorage.getItem('category'));
					}
					if(response.status == 'failed'){
					}
					if(response.status == 'error'){
					}
				  	   $('#categoryModal .leftside-list').html(html);
					},
						'error' : function(error){
					  	console.log(error);
						},
						complete: function() {

						},
					});

					$.ajax({
					"headers":{
					'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
					'type':'GET',
					'url' : "{{route('ajax.sub.category')}}" + '/' + localStorage.getItem('category'),
					beforeSend: function() {

					},
					'success' : function(response){
					let html = '';
					if(response.status == 'success'){
					if(response.data.length > 0)
					html += subCategory(response.data,localStorage.getItem('sub_category'));
					}
					if(response.status == 'failed'){
					}
					if(response.status == 'error'){
					}
				  	   $('#categoryModal .rightside-list').html(html);
					},
						'error' : function(error){
					  	console.log(error);
						},
						complete: function() {

						},
					});

			});

			     //Get Sub-Category
				 $('body').on('click','.main-category',function(e){
					e.preventDefault();
					$(this).parents('ul').find('li').removeClass('active');
			        $(this).addClass('active');
					let categoryId   = $(this).attr('data-id');
					let categoryName = $(this).attr('data-name');
					localStorage.setItem("category", categoryId);
					localStorage.setItem("category_name", categoryName);
					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'GET',
						'url' : "{{route('ajax.sub.category')}}" + '/' + categoryId,
					beforeSend: function() {

					},
					'success' : function(response){
						let html = '';
						if(response.status == 'success'){
							if(response.data.length > 0)
							html += subCategory(response.data);
						}
						if(response.status == 'failed'){
						}
						if(response.status == 'error'){
						}
						$('.rightside-list').html(html);
					},
					'error' : function(error){
						console.log(error);
					},
					complete: function() {

					},
					});
                });

				//Get City
				$('body').on('click','.sub-category',function(e){
						e.preventDefault();
						$(this).parents('ul').find('li').removeClass('active');
			            $(this).addClass('active');
						let subCategory = $(this).attr('data-id');
						let subCategoryName = $(this).attr('data-name');
						localStorage.setItem("sub_category", subCategory);
						localStorage.setItem("sub_category_name", subCategoryName);
						$('input[name="category"]').val(localStorage.getItem('category'));
						$('input[name="sub_category"]').val(subCategory);
						$('.category-text').text(localStorage.getItem('category_name'));
						getFormFields(localStorage.getItem('sub_category'),function(resnponse){
							if(resnponse.status == true){
							dynamicFormField(resnponse.data);
							}
						});
			    });

			//Get Area
				$('body').on('click','.city',function(e){
					e.preventDefault();
					$(this).parents('ul').find('li').removeClass('active');
  			        $(this).addClass('active');
					let city = $(this).attr('data-id');
					let cityName = $(this).attr('data-name');
					localStorage.setItem("city", city);
					localStorage.setItem("city_name", cityName);
					$.ajax({
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'GET',
						'url' : "{{route('ajax.city.area')}}" + '/' + city,
					beforeSend: function() {

					},
					'success' : function(response){
						let html = '';
						if(response.status == 'success'){
							if(response.data.length > 0)
							html += area(response.data);
						}
						if(response.status == 'failed'){
						}
						if(response.status == 'error'){
						}
						$('.rightside-list').html(html);
					},
					'error' : function(error){
						console.log(error);
					},
					complete: function() {

					},
					});
			});

			$('body').on('click','.area',function(e){
				e.preventDefault();
				$(this).parents('ul').find('li').removeClass('active');
				$(this).addClass('active');
				let area = $(this).attr('data-id');
				let areaName = $(this).attr('data-name');
				localStorage.setItem("area", area);
				localStorage.setItem("area_name", areaName);
				$('input[name="city"]').val(localStorage.getItem('city'));
				$('input[name="local_area"]').val(area);
				$('.location-text').text(localStorage.getItem('area_name'));
	       });

</script>
@endpush