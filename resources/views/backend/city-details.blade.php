@extends('backend.layouts.loggedInApp')
@section('content')
				<div class="main-body">
                    @include('backend.common.alert')
					<div class="inner-body">
						<!--header-->
						<div class="header">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="title">
										<!-- <h2>My Tenders</h2> -->
										<p class="navigation">
											<a href="{{route('admin.cities')}}">{{__('City List')}}</a>
											<a href="javascript:void(0)">{{__('Update City')}}</a>
											<a href="javascript:void(0)">{{ $data['city']->title }} ({{$data['city']->title_bn}}) </a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<form action="{{route('admin.city.update',$data['city']->id)}}" method="post">
								@csrf
								{{ method_field('PUT')}}
								<div class="row">
									<!--supplier profile-->
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="profile-details">
											<div class="row">
												<div class="col-md-12">
													<div class="input-details">
														<div class="form-group">
                                                            <select class="form-control" name="type">
                                                            	<option @if(old('type') == 'city') selected @else @if($data['city']->type == 'city') selected @endif @endif value="city">{{__('City')}}</option>
                                                            	<option @if(old('type') == 'division') selected @else @if($data['city']->type == 'division') selected @endif @endif value="division">{{__('Division')}}</option>
                                                            </select>
															@if ($errors->has('type'))
															   <span class="text-error">{{ $errors->first('type') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="{{old('title_en') ?? $data['city']->title }}" >
															@if ($errors->has('english_title'))
															   <span class="text-error">{{ $errors->first('english_title') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-details">
														<div class="form-group">
															<input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="{{old('title_bn') ?? $data['city']->title_bn }}" >
															@if ($errors->has('bangla_title'))
															   <span class="text-error">{{ $errors->first('bangla_title') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											@can('update' , App\Models\City::class)
										    	<button class="btn-theme">{{__('Update')}}</button>
											@endcan
										</div>
									</div><!--END supplier profile-->
								</form>
												<!--supplier profile-->
									<div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="new-city-area-list">
                                            <div class="city-area-list">
                                                    @forelse($data['city']->areas as $key => $area)
                                                        @if(!is_null($area->delete_at))
                                                        @php continue @endphp
                                                        @endif
                                                        <form action="{{route('admin.area.update')}}" method="POST" class="update-area-form">
                                                            @csrf
                                                            <div class="profile-details">
																@can('delete' , App\Models\City::class)
                                                                <label class="btn-dlt-wrapper">
                                                                    <i class="fa fa-trash btn-dlt" data-city-id="{{$data['city']->id}}" data-url="{{ route('admin.area.remove',$area->id)}}"></i>
																</label>
																@endcan
                                                                @csrf
                                                                {{ method_field('PUT')}}
                                                                <input type="hidden" name="area_id" value="{{$area->id}}">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="input-details">
                                                                            <div class="form-group">
                                                                            <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="{{$area->title}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-details">
                                                                            <div class="form-group">
                                                                                <input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="{{$area->title_bn}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-wrapper">
																	@can('update' , App\Models\City::class)
																		<button class="btn-theme btn-edit">{{__('Edit')}}</button>
																		<button style="display: none;" class="btn-theme btn-reset">{{__('Reset')}}</button>
																		<input style="display: none;"type="submit" class="btn-theme btn-update" value="{{__('Update')}}">
															        @endcan
																</div>
                                                            </div>
                                                        </form>
                                                    @empty
                                                    @endforelse
											</div>
											@can('create' , App\Models\City::class)
                                            <form action="{{route('admin.area.add')}}" method="POST" class="add-area-form">
                                                <div class="profile-details">
                                                        @csrf
                                                        <input type="hidden" name="city_id" value="{{$data['city']->id}}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-details">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-details">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="submit" class="btn-theme" value="{{__('Add')}}">
                                                </div>
											</form>
											@endcan
                                        </div>
										
									</div><!--END supplier profile-->
								</div>
							</form>
						</div><!--END supplier-details-->
					</div>
				</div>
@endsection
@push('css')
 <style type="text/css">
 </style>
@endpush
@push('js')
 <script type="text/javascript">

     // Get Subcity
 	  let getCityArea = function (){
					$.ajax(
					{
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'get',
						'url' : "{{route('admin.area.list',$data['city']->id)}}",
					beforeSend: function() {

					},
					'success' : function(response){
              	        $('.city-area-list').html(response);
					},
  					'error' : function(error){
					},
					complete: function() {
					},
					});
 	  }

 	   //Image Preview
      $('input[type="file"]').on('change',function(event){
      // event.preventDefault();
       tmppath = URL.createObjectURL(event.target.files[0]);
      });
      $('select[name="city"]').on('change',function(e){
      	  if(e.target.value != ''){ $('input[type="file"]').parents('.input-details').hide(); }else{ $('input[type="file"]').parents('.input-details').show();;}
      	   
      });

       $('.add-area-form').on('submit',function(e){
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
				click.find('.text-error').remove();
			if(response.status == 'success'){
			      swal("Success!",response.message, "success");
  				  click.find('input[type="text"]').val('');
					setTimeout(() => {
						   	  location.reload();
							}, 1500);
			}
			if(response.status == 'failed'){
			     swal("Failed!",response.message, "error");
			}
			if(response.status == 'error'){
				$.each(response.errors, function (key, val) {
				click.find('[name='+key+']').after('<span class="text-error">'+val+'</span>');
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

       $('.update-area-form').on('submit',function(e){
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
				click.find('input[type="text"]').val('');
			if(response.status == 'success'){
			      swal("Success!",response.message, "success");
				  setTimeout(() => {
						   	  location.reload();
							}, 1500);
			}
			if(response.status == 'failed'){
			     swal("Failed!",response.message, "error");
			}
			if(response.status == 'error'){
				$.each(response.errors, function (key, val) {
				click.find('[name='+key+']').after('<span class="text-error">'+val+'</span>');
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

       $('body').on('click','.btn-reset',function(e){
		    e.preventDefault();
               location.reload();
       });

       $('body').on('click','.btn-edit',function(e){
       	  e.preventDefault();
       	  $(this).hide();
       	  let form = $(this).parents('.update-area-form');
       	      form.find('input[type="text"]').removeAttr('readonly');
       	      form.find('.btn-update').show();
       	      form.find('.btn-reset').show();
       });

         $('.btn-dlt').on('click',function(e){
		  	  var url = $(this).attr('data-url');
	          var parentCategoryId = $(this).attr('data-city-id');
	          var data = { city_id : parentCategoryId };
			  swal({
			  title: "{{__('Are you sure?')}}",
			  text: "{{__('Once deleted, you will not be able to recover this city area!')}}",
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
						'type':'DELETE',
						'url' : url,
						'data' : data,
					beforeSend: function() {
					},
					'success' : function(response){
						if(response.status == 'success'){
							swal("Success!",response.message, "success");
							setTimeout(() => {
						   	  location.reload();
							}, 1500);
						}
						if(response.status == 'failed'){
							swal("Failed!",response.message, "error");
						}
					},
					'error' : function(error){
					},
					complete: function() {
					},
					});
			 });
	     });

		     @if(!Auth::user()->can('update',App\Models\City::class))
				$('input,select,textarea').attr('disabled','disabled');
		  	 @endif

 </script>
@endpush

