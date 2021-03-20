@extends('backend.layouts.loggedInApp')
@section('content')
				<div class="main-body">

					<div class="inner-body">
						<!--header-->
						<div class="header">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="title">
										<!-- <h2>My Tenders</h2> -->
										<p class="navigation">
											<a href="my_users.html">User List</a>
											<a href="Myuser-details.html"> Details</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="text">
										<label class="id">User ID:#{{$data['user']->id}}</label>
									</div>
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<div class="row">
								<!--supplier profile-->
								<div class="col-md-7 col-sm-7 col-xs-12">
									<div class="profile-details">
										<div class="profile-star clearfix">
											<div class="img">
												<img onerror="profileImgError(this)" src="{{$data['user']->user_image}}" class="img-responsive">
											</div>
										</div>
												

										<div class="active-inactive">
											  <span>Active</span>
											  <label data-status="{{$data['user']->is_active == '1' ?  0 : 1 }}" class="switch change-status">
												<input value="1" type="checkbox" @if($data['user']->is_active == '1') checked @endif>
												<span class="slider round"></span>
											  </label>
										</div>
 
										<div class="input-details">
											<div class="form-group">
												<input class="form-control" type="text" placeholder="Name" name="" value="{{$data['user']->name}}" readonly>
											</div>
											<div class="form-group">
												<input type="email" value="{{$data['user']->email}}" placeholder="Email" class="form-control" name="" readonly>
											</div>
											<div class="form-group">
												<input type="text" value="{{$data['user']->mobile}}" placeholder="Number" class="form-control" name="" readonly>
											</div>
											
										</div>

									</div>
								</div><!--END supplier profile-->

								<!--supplier documents-->
								<div class="col-md-5 col-sm-5 col-xs-12">
								
								</div><!--END supplier documents-->

							</div>
						</div><!--END supplier-details-->
					</div>
				</div>
@endsection
@push('js')
  <script type="text/javascript">

  	  	$('body').on('click','.change-status',function(e){
         e.preventDefault();
         var click  = $(this);
         var status = $(this).attr('data-status');
         if(status == '1')
         	  var text = 'active';
         else
          	  var text = 'deactive';
  	  	 swal({
		  title: "Are you sure?",
		  text: "What to "+text+" this user",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		 })
		 .then((willDelete) => {
			if(!willDelete){
				return false;
			}

          var id = $(this).attr('data-id');
				$.ajax({
					"headers":{
					'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
				},
					'type':'PUT',
					'url' : '{{route('admin.user.change.status',$data['user']->id)}}',
				beforeSend: function() {
				},
				'success' : function(response){
					if(response.status == 'success'){
						swal("Success!",response.message, "success");
						setTimeout(function(){ location.reload(); }, 1500);
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

  </script>
@endpush