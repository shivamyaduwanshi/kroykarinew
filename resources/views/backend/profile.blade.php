@extends('backend.layouts.loggedInApp')
@section('content')
<div class="main-body">
@include('backend.common.alert')
					<div class="inner-body">
						<!--header-->
						<div class="header">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="title">
										<!-- <h2>My Tenders</h2> -->
										<p class="navigation">
   										   <a href="javascript::void(0)">My Profile</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="text">
									</div>
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details">
							<div class="row">
								<!--supplier profile-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<form method="POST" action="{{ route('admin.profile.update') }}" id="update-profile-form" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT')}}
										<div class="profile-details">
											<div class="profile-star clearfix">
												<div class="img">
													
													<label>
                                                    <span class="edit"><i class="fas fa-pencil-alt"></i></span>
															<img onerror="profileImgError(this)" src="{{$data['user']->profile_image}}" class="img-responsive image-preview">
															<input type="file" name="profile_image" accept="image/*">
													</label>
												</div>

												<div class="star">
													<button type="submit">Save Profile</button>
												</div>
											</div>
											<div class="input-details">
												<div class="form-group">
												<input class="form-control" type="text" placeholder="Name" name="name" value="{{old('name') ?? $data['user']->name}}" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
													@if ($errors->has('name'))
														<span class="invalid-feedback" role="alert">
														   <strong>{{ $errors->first('name') }}</strong>
														</span>
													@endif
												</div>
												<div class="form-group">
													<input type="email" placeholder="Email" class="form-control" name="email" value="{{old('email') ?? $data['user']->email}}" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
														@if ($errors->has('email'))
														<span class="invalid-feedback" role="alert">
														   <strong>{{ $errors->first('email') }}</strong>
														</span>
													@endif
												</div>
												<div class="form-group">
												   <input type="number" placeholder="Mobile" class="form-control" name="phone" value="{{old('phone') ?? $data['user']->phone}}" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}">
														@if ($errors->has('phone'))
														<span class="invalid-feedback" role="alert">
														   <strong>{{ $errors->first('phone') }}</strong>
														</span>
													@endif
												</div>

											</div>
										</div>
								    </form>
                                </div><!--END supplier profile-->
                                
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <!--change pass-->
									<div class="supplier-documents">
								 		<form method="POST" action="{{ route('admin.change.password') }}" id="change-password">
								 			@csrf
								 			{{ method_field('PUT')}}
									    	<!--single-department-->
											<div class="single-department add-department">
												<h2>Change Password</h2>
												<div class="form-group">
													<input type="password" placeholder="Current Password" value="" name="old_password">
												</div>

												<div class="form-group">
													<input type="password" placeholder="New Password" value="" name="new_password">
												</div>

												<div class="form-group">
													<input type="password" placeholder="Confirm Password" value="" name="confirm_password">
												</div>

												<div class="add-btn">
													<button type="submit">Change Password</button>
												</div>
											</div><!--end-->
										</form>
								    </div>
								    <!--change pass-->
                                </div>
							</div>
						</div><!--END supplier-details-->

					</div>	
				</div>
@endsection
@push('js')
  <script type="text/javascript">

  	  //Image Preview
	  $('input[name="profile_image"]').on('change',function(e){
	   	  tmppath = URL.createObjectURL(event.target.files[0]);
		  $('.image-preview').attr('src',tmppath);
	  });

  	  // store or update clinic
      $('#update-profile-form').on('submit',function(e){
			e.preventDefault();
			var click = $(this);
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
 				  click.find('span').hide();
				if(response.status == 'success'){
   			      swal("Success!",response.message, "success");
				}
				if(response.status == 'failed'){
				  swal("Failed!",response.message, "error");
				}
				if(response.status == 'error'){
					 $.each(response.errors, function (key, val) {
					 click.find('[name='+key+']').after('<span style="color:red">'+val+'</span>');
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

      $('body').on('submit','#change-password',function(e){
	 	e.preventDefault();
	    var click = $(this);
		let form  = $(this);
	    let data = form.serialize();
		$.ajax({
			"headers":{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
		},
			'type':'PUT',
			'url' : form.attr('action'),
			'data' : data,
		beforeSend: function() {

		},
		'success' : function(response){
				click.find('span').remove();
				click.find('input').val('');
			if(response.status == 'success'){
			      swal("Success!",response.message, "success");
			}
			if(response.status == 'failed'){
			  swal("Failed!",response.message, "error");
			}
			if(response.status == 'error'){
				$.each(response.errors, function (key, val) {
				click.find('[name='+key+']').after('<span style="color:red">'+val+'</span>');
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