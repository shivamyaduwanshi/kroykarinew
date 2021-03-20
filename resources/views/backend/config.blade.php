@extends('backend.layouts.loggedInApp')
@section('content')
    <div class="main-body">
           @include('backend.common.alert')
           <!-----START searching box--------->
          <section class="searching-filter">
            <form method="GET">
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input">
                        <input type="text" placeholder="Search by key" name="key" value="{{Request::get('key')}}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="filter-btn">
                    <a class="button" href="{{route('admin.config')}}">Clear</a>
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
                  </div>
                </div>
              </div>
            </div><!--END header-->

            <!--my tenders-->
            <div class="supplier-request table-responsive">
                <table class="table table-striped">
                  <tr>
                     <thead>
                        <th>Sr.</th> 
                        <th>Config Key</th>
                        <th>Language</th>
                        <th>Value</th>
                        <th>Action</th>
                     </thead>
                     <tbody>
                        @php $i = 1 @endphp
                        @foreach($data['config'] as $key => $config)
                           <tr>
                             <td>{{$i++}}</td>
                             <td>{{$config->key}}</td>
                             <td>{{$config->lang}}</td>
                             <td style="overflow: hidden;
                             text-overflow: ellipsis;
                             display: -webkit-box;
                             -webkit-line-clamp: 2; /* number of lines to show */
                             -webkit-box-orient: vertical;width:300px"><?= $config->value ;?></td>
                             <td>
                              @if(Auth::user()->can('update',App\Models\Config::class))
                                <a href="{{route('admin.get.config',$config->id)}}" class="btn edit-btn">Edit</a>
                              @else
                                <a href="{{route('admin.get.config',$config->id)}}" class="btn edit-btn">View</a>
                              @endif
                             </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </tr>
                </table>
            </div><!--END my tenders-->

          </div>  
        </div>
@endsection
@push('css')
{{--  <style type="text/css">
   table tbody tr td{
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
   }
 </style> --}}
@endpush
@push('js')
@endpush