@extends('layouts.app')
@section('content')

	<!--ad details-->
	<section class="product-list-page">
		<div class="container-fluid">
			<div class="navcigation">
				<ul>
					<li><a href="index.html">{{__('Home')}}</a></li>
					<li><a href="product_list.html">{{__('Ad List')}}</a></li>
				</ul>
			</div>
		
			<div class="google-ads google-ads2">
				<img src="{{asset("frontend")}}/images/ad3.jpg" alt="google ad" class="img-fluid">
			</div>

			<div class="row">
				<!--filter-->
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="page-filter">
						<div class="filter-btn clearfix">
							<p>{{$data['ads']->total()}} {{__('ads')}}</p>
							<button class="filter-toggle"><i class="fas fa-filter"></i> {{__('Filter')}}</button>
						</div>
						<div class="mobile-filter-mode">
							<div class="filter-main-wrapper">                                
								<div class="filter-box clearfix">
									<div class="heading clearfix">
										<h2>{{__('Filter')}}</h2>
										<button class="filter-toggle"><i class="fas fa-times"></i></button>
									</div>
	                                <form id="filter-form">
										<div class="filters">
											<ul>
												<li>
													<div class="clearfix f">
														<span class="name">{{__('Categories')}}</span>
														<span class="arrow"><i class="fas fa-chevron-right"></i></span>
													</div>
			
													<!--sub filter-->
														<div class="sub-filter1 select-box ch-wrapper ch-categories">
															<div class="custom-control custom-radio">
															  <input type="radio" class="custom-control-input" id="all_categories" @if(strtolower(Request::get('cat')) == '') checked @endif value="" name="cat">
															  <label class="custom-control-label" for="all_categories">{{__('All Categories')}}</label>
															</div>
		                                                    
		                                                    @forelse($data['categories'] as $category)
															<div class="custom-control custom-radio">
															  <input @if(strtolower(Request::get('cat')) == strtolower($category->title_value)) checked @endif type="radio" class="custom-control-input" id="categories_{{$category->id}}" name="cat" value="{{$category->title_value}}">
															  <label class="custom-control-label" for="categories_{{$category->id}}">{{$category->title_name ?? ''}} <span>({{$category->totalAd(Request::all())}})</span> </label>
															</div>
															@empty
															@endforelse
														
														</div>
													<!--end-->
												</li>
		
												<li>
													<div class="clearfix f">
														<span class="name">{{__('City or Division')}}</span>
														<span class="arrow"><i class="fas fa-chevron-right"></i></span>
													</div>
			
													<!--sub filter-->
													<div class="sub-filter1 select-box">
														<select name="city" class="">
	                                                       @forelse($data['cities'] as $key => $city)
	                                                         @if($key == '0')
	                                                           <option value="">{{__('Select City')}}</option>
	                                                         @endif
	                                                         <option @if(strtolower($city->title_value) == strtolower(Request::get('city'))) selected @endif value="{{$city->title_value}}">{{$city->title_name}}</option>
	                                                       @empty
	                                                       @endforelse
														</select>
													</div>
													<!--end-->
			
												</li>

												<li>
													<div class="clearfix f">
														<span class="name">{{__('Local Area')}}</span>
														<span class="arrow"><i class="fas fa-chevron-right"></i></span>
													</div>
			
													<!--sub filter-->
													<div class="sub-filter1 select-box">
														<select name="area" class="">
															<option value="">{{__('First Select City')}}</option>
														</select>
													</div>
													<!--end-->
			
												</li>

		
{{-- 												<li>
													<div class="clearfix f">
														<span class="name">Condition</span>
														<span class="arrow"><i class="fas fa-chevron-right"></i></span>
													</div>
			
													<!--sub filter-->
													<div class="sub-filter1 select-box ch-wrapper">
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition1" name="">
														  <label class="custom-control-label" for="condition1">Any</label>
														</div>
		
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition2" name="">
														  <label class="custom-control-label" for="condition2">New</label>
														</div>
		
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition3" name="">
														  <label class="custom-control-label" for="condition3">Like New</label>
														</div>
		
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition4" name="">
														  <label class="custom-control-label" for="condition4">Good</label>
														</div>
		
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition5" name="">
														  <label class="custom-control-label" for="condition5">Fair</label>
														</div>
		
														<div class="custom-control custom-checkbox">
														  <input type="checkbox" class="custom-control-input" id="condition6" name="">
														  <label class="custom-control-label" for="condition6">Poor</label>
														</div>
													</div>
													<!--end-->
												</li> --}}
			
												<li>
													<div class="clearfix f">
														<span class="name">{{__('Price Range')}}</span>
														<span class="arrow"><i class="fas fa-chevron-right"></i></span>
													</div>
			
													<div class="price-range select-box clearfix">
														<div class="min">
															<input type="text" name="min" value="{{Request::get('min')}}" placeholder="{{__('Min')}}">
														</div>
														<div class="max">
															<input type="text" name="max" value="{{Request::get('max')}}" placeholder="{{__('Max')}}">
														</div>
														<div class="btns">
															<button><i class="fas fa-chevron-right"></i></button>
														</div>
													</div>
  			                                	    <input type="hidden" name="sort" value="">
												</li>
											</ul>
										</div>
	                                </form>
								</div>
							</div>
						</div>
					</div>
				</div><!--end-->

				<!--right-data-->
				<div class="col-md-9 col-sm-12 col-xs-12">
					<!--result-->
					<div class="result-shortby">
						<div class="row">
							<div class="col-md-6 col-sm-12 col-12">
								<p class="result">{{__('Total ad\'s')}}  <span>({{$data['ads']->total()}})</span> </p>
							</div>
							<div class="col-md-6 col-sm-12 col-12">
								<div class="short-by">
									<div class="select">
										<span>{{__('SORT BY')}}:</span>
										<select name="sort">
											<option value="">{{__('All')}}</option>
											<option value="featured">{{__('Only Feature ads')}}</option>
											<option value="lowest">{{__('Price: Lowest')}}</option>
											<option value="highest">{{__('Price: Highest')}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div> <!--end-->

					<!--ads-list-->
					<div class="ads-list">
						@forelse($data['ads'] as $ad)
						<!--single-ads-->
						<div class="single-ads">
							<button class="like-btn">
								<label>
									<input type="checkbox" name="heart" @if($ad->is_like) checked @endif>
									<span><i class="fa fa-heart like-ad" data-id="{{$ad->id}}"></i></span>
								</label>
							</button>

							<img class="featured-tag" src="{{asset("frontend")}}/images/featured.png" alt="">

							<a href="{{route('adShow',[$ad->id,urlencode($ad->title)])}}">
								<div class="img-txt clearfix">
									<div class="img">
										<img src="{{$ad->image}}" alt="{{__('ads image')}}">
									</div>
									
									<div class="txt">
										<h2>{{$ad->title}}</h2>
										<div class="lc">
											<h3>
												<i class="fa fa-map-marker-alt"></i>
												<span>{{__('Location')}}:</span>
												{{$ad->area->title_name}}&nbsp;({{$ad->city->title_name}})
											</h3>
											<h3>
												<i class="fa fa-briefcase"></i>
												<span>{{__('Category')}}:</span>
												{{$ad->category->title_name ?? ''}}
												<label class="sale tag">{{$ad->subCategory->title_name ?? ''}}</label>
											</h3>
											<h3>
												<i class="fa fa-clock"></i>
												{{$ad->created_at->diffForHumans()}}
											</h3>
										</div>

										<p>{{$ad->description}}</p>

										<label class="price">৳ {{$ad->price}}</label>
									</div>
								</div>
							</a>
						</div><!--end-->
						@empty
						@endforelse
					</div><!--end-->

					<!--pagination-->
				{{-- 	<div class="ads-pagination">
						<div class="wrapper">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-3">
									<button class="preview"><i class="fas fa-arrow-left"></i> Pre.</button>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<div class="pagination-number">
										<ul>
											<li><a href="javascript:void(0);">1</a></li>
											<li><a class="active" href="javascript:void(0);">2</a></li>
											<li><a href="javascript:void(0);">3</a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-3 text-right">
									<button class="preview">Next <i class="fas fa-arrow-right"></i></button>
								</div>
							</div>
						</div>
					</div><!--end--> --}}
				</div> <!--end-->
			</div>
		</div>
	</section> <!--end-->

@endsection
@push('js')
 <script type="text/javascript">

 	    // Get LocalAreas
  	    var getLocalAreas = function(id,callBack){
					$.ajax(
					{
						"headers":{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
						'type':'get',
						'url' : '{{url('ajax/city/area')}}' + '/' + id,
					beforeSend: function() {

					},
					'success' : function(response){
                        callBack(response);
					},
  					'error' : function(error){
					},
					complete: function() {
					},
					});
  	    }

  	    @if(Request::get('city'))
  	         @php
  	            $cityId   = '';
                $cityData = \DB::table('cities')->where('title',Request::get('city'))->first();
                if($cityData){
                  $cityId = $cityData->id;
                }
  	         @endphp
  	         let cityId = "{{$cityId}}";
			 let area   = "{{Request::get('area')}}";
			 console.log(area);
  	         @if($cityId)
		     	 getLocalAreas(cityId,function(resnponse){
		     	 	console.log(resnponse);
		     	 	 if(resnponse.status == 'success'){
		     	 	    	let option = '';
		     	 	 	    if(resnponse.data.length > 0){
			     	 	 	    resnponse.data.map(function(localArea,index){
			     	 	 	    	if(localArea.title == area){
                                         selected = 'selected';
			     	 	 	    	}else{
                                         selected = '';
			     	 	 	    	}
			     	 	 	    	if(index == 0){
			                          option += '<option value="">{{__('Choose Local Area')}}</option>';
			     	 	 	    	}
			                        option += `<option ${selected} value="${localArea.title_value}">${localArea.title_name}</option>`;
			     	 	 	    });
		     	 	 	    }else{
		     	 	 	    	option += '<option value="">{{__('Area not found')}}</option>';
		     	 	 	    }
		     	 	 	   $('select[name="area"]').html(option);
		     	 	 }

		     	 	 if(resnponse.status == 'failed'){
		     	 	 	
		     	 	 }
		     	 });
  	         @endif
  	    @endif

 	 $('select[name="city"]').on('change',function(e){
     	 e.preventDefault();
      });

 	 $('#filter-form select').on('change',function(e){
 	 	 $('#filter-form').submit();
 	 });

 	 $('#filter-form input[type="radio"]').on('change',function(e){
 	 	 $('#filter-form').submit();
 	 });
 	 
 	 $('select[name="sort"]').on('change',function(e){
         e.preventDefault();
         $('#filter-form input[name="sort"]').val(e.target.value);
         $('#filter-form').submit();
 	 });

 </script>
@endpush