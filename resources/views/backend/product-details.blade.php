@extends('backend.layouts.loggedInApp')
@section('content')
<div class="main-body">
@include('backend.common.alert')
					<div class="inner-body">
						<!--Start-->
						<div class="user-card-wrapper">
							<h2 class="title">User Details</h2>
							<div class="users-details-cart">
								<!--img-txt-->
								<div class="img-txt clearfix">
									<div class="img">
										<img onerror="profileImgError(this)" src="{{$data['ad']->user->profile_image}}" alt="User Image">
									</div>
									<div class="txt">
										<h2>{{$data['ad']->user->name ?? 'Not available' }}</h2>
										<p><i class="fas fa-envelope"></i> {{$data['ad']->user->email ?? 'Not available' }}</p>
										<p><i class="fas fa-phone-alt"></i> {{$data['ad']->user->mobile ?? 'Not available' }}</p>
										<p><i class="fas fa-calendar-alt"></i> Member since <span> {{date('d-M-Y',strtotime($data['ad']->user->created_at))}}</span></p>
									</div>
								</div><!--img-txt-->

							</div>
						</div><!--end-->

						<!--Start-->
						<div class="user-card-wrapper">
								<h2 class="title">Ad Details</h2>

								<div class="users-details-cart">
									<div class="description bpm">
											<label class="sub-heading">Product Status (@if($data['ad']->is_approved == '1') <span style="color:green"> Approved </span> @elseif($data['ad']->is_approved == '2') <span style="color:red"> Rejected </span> @else <span style="color:orange">In Review</span> @endif)</label>
											<br>
											@if( Auth::user()->can('reject',App\Models\Ad::class) || Auth::user()->can('approve',App\Models\Ad::class) )
												@if($data['ad']->is_approved == '0')
											    	@can('rejecct' , App\Models\Ad::class)
													   <button class="btn btn-danger btn-sm btn-reject">Reject</button>
													@endcan
													@can('approve' , App\Models\Ad::class)
													    <button class="btn btn-success btn-sm btn-confirm">Approved</button>
                                                    @endcan
												@elseif($data['ad']->is_approved == '1')
												    @can('rejecct' , App\Models\Ad::class)
												        <button class="btn btn-danger btn-sm btn-reject">Reject</button>
                                                     @endcan
												@endif
												@if($data['ad']->is_approved == '2')
													 @can('approve' , App\Models\Ad::class)
													    <button class="btn btn-success btn-sm btn-confirm">Approved</button>
												 	 @endcan
												@endif
											@endif
											@can('delete' , App\Models\Ad::class)
												@if(Request::get('status') != 'deleted')
												<button class="btn btn-danger btn-sm btn-delete">Delete</button>
												@endif
											@endcan
									</div>
									@if(Request::get('status') == 'rejected')
									<div class="cart-txt">
										<h2 class="title2">Reject Reason</h2>
										<div class="category bpm">
											<span>{{ $data['ad']->reject_reason}}</span>
										</div>
									@endif
									@if(Request::get('status') == 'deleted')
									<div class="cart-txt">
										<h2 class="title2">Delete Reason</h2>
										<div class="category bpm">
											<span>{{ $data['ad']->deleted_reason}}</span>
										</div>
									@endif
									<div class="cart-txt">
										<h2 class="title2">{{$data['ad']->title}}</h2>
										<div class="category bpm">
											<label class="sub-heading">Category</label>
											<span>{{$data['ad']->category->title}}</span>
											<span>{{$data['ad']->subCategory->title}}</span>
										</div>

										<div class="bpm">
											<div class="row">
													<div class="col-md-3">
														<div class="description">
															<label class="sub-heading">Price</label>
															<h5>$ {{$data['ad']->price}}</h5>
														</div>
													</div>

													<div class="col-md-3">
														<div class="description">
															<label class="sub-heading">Features</label>
															
															<div class="custom-checkbox">
																<label class="single-checkbox">
																	<input type="checkbox" @if($data['ad']->is_promotion) checked @endif" disabled>
																	<span class="checkmark"></span>
																</label>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="description">
															<label class="sub-heading">Approved</label>
															<div class="custom-checkbox">
																<label class="single-checkbox">
																	<input type="checkbox" @if($data['ad']->is_approved) checked @endif" disabled>
																	<span class="checkmark"></span>
																</label>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="description">
															<label class="sub-heading">Expiry Day's</label>
															<p>{{$data['ad']->expiry_day ?? '-'}}</p>
														</div>
													</div>
												</div>
										</div>
									
										@foreach ($data['fields'] as $field )
									         	<label class="sub-heading">{{$field->field_name}}</label>
												 <div class="description bpm">
										     	 @if($field->field_type != 'checkbox')
												   <p>{{$field->field_type != 'text' ? $field->value : $field->value }}</p>
											  	 @else
													@php
														$str = '';
														if($field->value){
															foreach(json_decode($field->value) as $value){
																$str .= $value . ',';
															}
														}
													@endphp
												    <p>{{$field->field_name}}: <span> {{ substr($str, 0, -1) }}</span></p>
												 @endif
												 </div>
										 	 @endforeach
									     </div>

										<div class="description bpm">
											<label class="sub-heading">Location</label>
											<p>{{$data['ad']->area->title}}&nbsp;({{$data['ad']->city->title}})</p>
										</div>
									
								</div>
						</div><!--end-->

							<!--Start-->
						<div class="user-card-wrapper">
							<h2 class="title">Images</h2>
							@if($data['ad']->images)
							<div class="images custom-img-box pictures-viewers">
                                <!--single img-->
                                @foreach($data['ad']->images as $image)
                                    <div class="img">
                                        <img data-original="{{$image['name']}}" onerror="productImgError(this)" src="{{$image['name']}}" alt="Product Image">
                                    </div>
                                @endforeach
							</div>
							@else
							 <p>Image not available</p>
							@endif
						</div><!--end-->

					</div>	
				</div>
	    <!-- Modal -->
        <div class="modal fade" id="reject-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Give Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form action="{{route('admin.reject.ad',encrypt($data['ad']->id))}}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group">
                      <textarea class="form-control" name="reason" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Reject</button>
                </div>
                </form>
            </div>
          </div>
		</div>
		
			<!-- Modal -->
			<div class="modal fade" id="delete-product-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="deleteModalLabel">Please Give Reason</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					  <form action="{{route('admin.delete.ad',encrypt($data['ad']->id))}}" method="post">
						  @csrf
						  {{ method_field('DELETE') }}
					  <div class="modal-body">
						  <div class="form-group">
							<textarea class="form-control" name="reason" required></textarea>
						  </div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					  </div>
					  </form>
				  </div>
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

       $('.btn-confirm').on('click',function(e){
           window.location.href = "{{route('admin.approved.ad',encrypt($data['ad']->id))}}";
       });

       $('.btn-reject').on('click',function(e){
           $('#reject-product-modal').modal('show');
       });
    
	   $('.btn-delete').on('click',function(e){
            $('#delete-product-modal').modal('show');
	   });

  </script>
@endpush