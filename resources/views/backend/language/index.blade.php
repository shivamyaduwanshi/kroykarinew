@extends('backend.layouts.loggedInApp')
@section('content')
    <div class="main-body">
      <div class="row">
        <div class="col-md-11">
         <h3>Language Translate</h3>
        </div>
     <div class="col-md-12">
      <table class="table table-condensed table-stripe" id="languageTable">
     <thead>
       <tr>
         <th>Sr.</th>
         <th>Key</th>
         <th>Value</th>
         @can('update' , App\Models\Translate::class)
         <th>Action</th>
         @endcan
       </tr>
     </thead>
     <tbody>
       @php $i = 0 @endphp
       @forelse($data['language'] as $key => $value)
         <form class="form" action="{{route('admin.language.update.bangla')}}" method="POST">
           @csrf
           @method('PUT')
          <tr>
            <td>{{++$i}}</td>
            <td>{{str_replace('_',' ',strtolower($key))}}<input type="hidden" name="key" value="{{$key}}" class="form-control"></td>
            <td><input type="text" name="value" value="{{$value}}" class="form-control input-sm"></td>
            @can('update' , App\Models\Translate::class)
            <td>
             <div class="btn-group">
               <input type="submit" value="Update" class="btn btn-primary">
             </div> 
           </td>
           @endif
          </tr>
         </form>
       @empty
       @endforelse
     </tbody>
     <tfoot>
       <tr>
   
       </tr>
     </tfoot>
   </table>
     </div>
    </div>
 
   </div>
 
 @endsection
 @push('css')
    <style type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>
 @endpush
 @push('js')
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
   <script type="text/javascript">
      $(document).ready(function() {
       // $('#languageTable').dataTable();

       // Update Transaction file
       $('#languageTable .form').on('submit',function(e){
          e.preventDefault();
          var click = $(this);
          let form  = $(this);
          let data  = form.serialize();
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
              console.log(response);
              if(response.status == true){
                toastr.success(response.message);
              }
              if(response.status == false){
                toastr.error(response.message);
              }
          },
          'error' : function(error){
            console.log(error);
          },
          complete: function() {

          },
          });
      });

       @if(!Auth::user()->can('update',App\Models\Translate::class))
        $('input,select,textarea').attr('disabled','disabled');
       @endif

      });
   </script>
 @endpush

 