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
                        <input type="text" placeholder="Search by field name" name="search" value="{{Request::get('search')}}">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="filter-btn">
                    <a class="button" href="{{route('admin.field.index')}}">Clear</a>
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
                    <h2>Field List ({{count($fields)}})</h2>
                    @can('create' , App\Models\Field::class)
                    <a style="float: right;" class="btn-theme" href="{{route('admin.field.create')}}">Add Field</a>
                    @endcan
                  </div>
                </div>
              </div>
            </div><!--END header-->

            <!--my tenders-->
            <div class="supplier-request">
              <div class="row">
                @forelse($fields as $key => $field)
                  <!--single-s-request-->
                  <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="single-s-request">
                      <div class="img-text clearfix">
                        <b>Name</b> : {{ucFirst($field->name)}}<br>
                        <b>Type</b> &nbsp;&nbsp;: {{ucFirst($field->type)}}<br>
                        <b>Option &nbsp;&nbsp;&nbsp;</b>
                        @php 
                          $opt = '';
                          if($field->options){
                              foreach($field->options as $key => $option){
                                  if($key == 0){
                                    $opt .= $option->option;
                                  }else{
                                      $opt .= ',' . $option->option;
                                  }
                              }
                          }
                        @endphp
                        {{ $opt }}
                      </div>
                      <div class="buttons txt">
                      <a href="{{route('admin.field.edit',$field->id)}}">Details</a>
                      @can('delete' , App\Models\Field::class)
                      <a class="btn-danger btn-dlt" href="javascript:void()" data-url="{{route('admin.field.destroy',$field->id)}}">Delete</a>
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
            text: "What to delete this field",
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
            console.log(response);
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