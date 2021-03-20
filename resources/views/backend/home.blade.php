@extends('backend.layouts.loggedInApp')
@section('content')
 <div class="main-body">
   <div class="dashboard-data">
   		<div class="row">
              @can('index' , App\Models\User::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.users')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Users</h2>
                        <h3>{{$data['totalUser']}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\Ad::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.ads',['status'=>'running'])}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Ads</h2>
                        <h3>{{\DB::table('ads')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\Category::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.categories')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Categories</h2>
                        <h3>{{\DB::table('categories')->whereNull('parent_id')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\Category::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.categories')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Sub-Categories</h2>
                        <h3>{{\DB::table('categories')->whereNotNull('parent_id')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\City::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.cities')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Cities</h2>
                        <h3>{{\DB::table('cities')->where('type','city')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\City::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.cities')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Divisions</h2>
                        <h3>{{\DB::table('cities')->where('type','division')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
               @can('index' , App\Models\City::class)
               <div class="col-md-3 col-sm-4 col-xs-12">
                  <a href="{{route('admin.cities')}}">
                  <div class="single-data">
                     <div class="img">
                        <i class="fa fa-layer-group"></i>
                     </div>
                     <div class="txt">
                        <h2>Local Areas</h2>
                        <h3>{{\DB::table('city_areas')->whereNull('deleted_at')->count()}}</h3>
                     </div>
                  </div>
                  </a>
               </div>
               @endcan
   		</div>
   </div>
 </div>

 <style type="text/css">
 	.dashboard-data a{
      display: block;
 	}
 	.dashboard-data .single-data{
 		padding: 20px 15px;
 		text-align: center;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    margin-bottom: 30px;
 	}
  .dashboard-data .single-data:hover .img i{
    color: #000 !important;
    transform: scale(1.2);
  }
 	.dashboard-data .single-data .img{
 		margin: 0 0 20px;
 	}
 	.dashboard-data .single-data .img i{
 		font-size: 40px;
 		color: #1caeb3;
    transition: all 0.5s;
 	}
 	.dashboard-data .single-data .txt{
 		
 	}
 	.dashboard-data .single-data .txt h2{
 		margin: 0px 0px 10px;
    font-size: 18px;
    font-weight: 600;
    color: #000;
 	}
 	.dashboard-data .single-data .txt h3{
 		margin: 0;
    font-size: 20px;
    font-weight: 600;
    color: #1caeb3;
 	}
 </style>
@endsection