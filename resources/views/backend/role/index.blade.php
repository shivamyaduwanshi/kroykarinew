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
                        <input type="text" placeholder="Search by Group Name name="search" value="{{Request::get('search')}}">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="filter-btn">
                    <a class="button" href="{{route('admin/role/index')}}">Clear</a>
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
                    <h2>Groups ({{$data['roles']->total()}})</h2>
                    @can('create' , App\Models\Role::class)
                       <a style="float: right;" class="btn-theme" href="{{route('admin/role/create')}}">Add Group</a>
                    @endcan
                  </div>
                </div>
              </div>
            </div><!--END header-->

            <!--my tenders-->
            <div class="supplier-request">
              <div class="row">
                @forelse($data['roles'] as $key => $role)
                <!--single-s-request-->
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="single-s-request">
                    <div class="img-text">
                      <div class="txt m-0">
                        <h2>{{$role->role_title}}</h2>
                      </div>
                    </div>
                    <div class="buttons txt">
                       <a href="{{route('admin/role/edit',['id' => $role->id ])}}">{{__('Details')}}</a>
                       @can('delete' , App\Models\Role::class)
                          <button class="btn btn-danger btn-dlt" data-url="{{route('admin/role/destroy',[ 'id' => $role->id])}}">Delete</button>
                       @endcan
                      </div>
                  </div>
                </div><!--END single-s-request-->
                @empty
              @endforelse
              </div>
            </div><!--END my tenders-->

          </div>  
        </div>
      
@endsection
@push('js')
 <script>
       $('body').on('click','.btn-dlt',function(e){
          e.preventDefault();
          var url    = $(this).attr('data-url');
          var click  = $(this);
           swal({
            title: "Are you sure?",
            text: "What to delete this group",
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