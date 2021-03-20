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
                        <input type="text" placeholder="{{__('Search by city , division & local area')}}" name="search" value="{{Request::get('search')}}">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="filter-btn">
                    <a class="button" href="{{route('admin.cities')}}">{{__('Clear')}}</a>
                    <button class="button" type="submit">{{__('Submit')}}</button>
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
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="title">
                    <h2>{{__('City Or Division')}} ({{count($data['cities'])}})</h2>
                  </div>
                </div>
                @can('create' , App\Models\City::class)
                <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                    <a class="btn-theme" href="{{route('admin.city.add')}}">{{__('Add City')}}</a>
                </div>
                @endcan
              </div>
            </div><!--END header-->

            <!--my tenders-->
            <div class="supplier-request cities-list">
              <div class="row">
                @forelse($data['cities'] as $key => $city)
                  <!--single-s-request-->
                  <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="single-s-request">
                      <div class="img-text">
                        <div class="txt m-0">
                          <h2>{{$city->title}} ({{$city->title_bn}})</h2>
                          <p><b>{{__('Local Area')}} :</b>
                             @forelse($city->areas as $area)
                                {{$area->title}},
                             @empty
                               {{__('Not availabe')}}</p>
                             @endforelse
                        </div>
                      </div>
                      <div class="buttons txt">
                      <a href="{{route('admin.city.edit',$city->id)}}">{{__('Details')}}</a>
                       @can('delete' , App\Models\City::class)
                        <a class="btn-danger btn-dlt" href="javascript:void()" data-url="{{route('admin.city.remove',$city->id)}}">Delete</a>
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
<script type="text/javascript">
       $('body').on('click','.btn-dlt',function(e){
          e.preventDefault();
          var url    = $(this).attr('data-url');
          var click  = $(this);
           swal({
            title: "Are you sure?",
            text: "What to delete this category",
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