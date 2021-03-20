@extends('backend.layouts.loggedInApp')
@section('content')
    <div class="main-body">
      @include('backend.common.alert')
           <!-----START searching box--------->
          <section class="searching-filter">
            <form method="GET">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input">
                        <input type="text" placeholder="Search by name, email , phone" name="search" value="{{Request::get('search')}}">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="filter-btn">
                    <a class="button" href="{{route('admin.users')}}">Clear</a>
                    <button class="button" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </section>
          <!-----END searching box--------->

          <div class="inner-body">
            <!--header-->
            <div class="header">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="title">
                    <h2>User List ({{$data['users']->total()}})</h2>
                  </div>
                </div>
              </div>
            </div><!--END header-->

            <!--my tenders-->
            <div class="supplier-request">
              <div class="row">
                @foreach($data['users'] as $key => $user)
                <!--single-s-request-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="single-s-request">
                    <div class="img-text clearfix">
                      <div class="img">
                           <img src="{{$user->profile_image}}" onerror="profileImgError(this)">
                      </div>
                      <div class="txt">
                         <h2>{{$user->name}}</h2>
                         <p><i class="fas fa-envelope"></i>{{$user->email}}</p>
                         <p><i class="fas fa-phone-alt"></i>{{$user->phone}}</p>
                         <p><i class="fas fa-registered" data-toggle="tooltip" title="Registration Date"></i>{{date('d,M Y',strtotime($user->created_at))}}</p>
                         <p class="user-id">User ID: #{{$user->id}}</p>

                         <div class="active-inactive">
                            <h3>Status: <span>{{$user->is_active == '1' ?  'Active' : 'Inactive' }}</span></h3>
                             @can('active' , App\User::class) 
                             <label data-id="{{$user->id}}" data-status="{{$user->is_active == '1' ?  0 : 1 }}" class="switch change-status">
                                 <input value="1" type="checkbox" @if($user->is_active == '1') checked  @endif>
                                 <span class="slider round"></span>
                             </label>
                             @endcan
                        </div>
                      </div>
                    </div>
                	<div class="buttons txt">
                        @can('resetpassword' , App\User::class)
                             <button data-id="{{$user->id}}" class="btn btn-reset-password btn-info">Reset Password</button>
                        @endcan
                        @can('delete' , App\User::class)
                             <button data-id="{{$user->id}}" class="btn btn-dlt btn-danger">Delete</button>
                        @endcan
				        	</div>
                  </div>
                </div><!--END single-s-request-->
                @endforeach
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                   {{-- Render Pagination --}}
                   {{ $data['users']->appends(request()->query())->links()  }}
                  </div>
              </div>
            </div><!--END my tenders-->

          </div>  
        </div>

        			<!-- Modal -->
			<div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="deleteModalLabel">Please Give Reason</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					  <form action="{{route('admin.user.delete')}}" method="post">
						  @csrf
              {{ method_field('DELETE') }}
              <input type="hidden" name="id" value="" />
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

           			<!-- Modal -->
			<div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="resetPaswordModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="deleteModalLabel">Reset Password</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					  <form action="{{route('admin.user.reset.password')}}" method="post">
						  @csrf
              {{ method_field('PUT') }}
              <input type="hidden" name="id" value="" />
					  <div class="modal-body">
						  <div class="form-group">
                <div class="row">
                  <div class="col-md-8">
                    <input type="text" name="password" placeholder="Password" class="form-control"/>
                  </div>
                  <div class="col-md-4">
                      <button class="btn btn-info btn-password-generate">Generate Password</button>
                  </div>
                </div>
						  </div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Reset</button>
					  </div>
					  </form>
				  </div>
				</div>
      </div>
      
@endsection
@push('js')
<script type="text/javascript">

  $('.btn-dlt').on('click',function(e){
    e.preventDefault();
    $('#delete-user-modal form input[name="id"]').val($(this).attr('data-id'));
    $('#delete-user-modal').modal('show');
  });

  $('.btn-reset-password').on('click',function(e){
    e.preventDefault();
    $('#reset-password-modal form input[name="id"]').val($(this).attr('data-id'));
    $('#reset-password-modal').modal('show');
  });

  $('.btn-password-generate').on('click',function(e){
    e.preventDefault();
    $('#reset-password-modal form input[name="password"]').val(randomstring = Math.random().toString(36).slice(-8));
  });

  $('body').on('click','.change-status',function(e){
          e.preventDefault();
          var click  = $(this);
          var status = $(this).attr('data-status');
          var userId = $(this).attr('data-id');
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
            'url' : '{{url("admin/user/change/status")}}' + '/' + userId,
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