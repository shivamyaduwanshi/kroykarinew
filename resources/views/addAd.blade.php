@extends('layouts.app')
@section('content')

	<!--post add-->
	<section class="post-add-fisrt padding-top">
		<div class="container">
			<div class="navcigation">
				<ul>
					<li><a href="{{route('home')}}">{{__('Home')}}</a></li>
					<li><a href="javascript:void(0)">{{__('Ad Post')}}</a></li>
				</ul>
			</div>

			<div class="wrapper">
				<div class="heading">
                    @if(auth::check())
						@if(app()->getLocale() == 'bn')
	 					  <h2>শিবমকে {{auth::user()->name}}! একটি বিজ্ঞাপন পোস্ট করতে দেয়</h2>
						@else
						   <h2>Welcome {{auth::user()->name}}! Let's post an ad</h2>
						@endif
                    @else
					  <h2>{{__('Welcome User! Let\'s post an ad')}}</h2>
                    @endif

					<p>{{__('Choose any option below')}}</p>
				</div>

				<div class="post-ad-options">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<h4 class="sub-heading leftside-subheading">{{__('Select a Category')}}</h4>
							<div  id="leftside-list">
								<ul>
									@foreach($categories as $key => $category)
									<li class="main-category" data-id="{{$category->id}}" data-name="{{$category->title}}">
										<div class="leading">
											<div class="icon"><img src="{{$category->image}}"></div>
											<div class="title">{{$category->title}}</div>
										</div>
										<div class="trailing"><i class="fas fa-angle-right"></i></div>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
 						  <div class="col-md-6 col-sm-6 col-xs-12">
							<h4 class="sub-heading rightside-subheading"></h4>
							<div  id="rightside-list"></div>
						  </div>
					</div>

	     @php 
			  $postingRules = '';
			  $postingAllowance = '';
			  $config = \DB::table('config')->select('key','value','lang')->get();
			  foreach ($config as $key => $con) {
					 if($con->key == 'posting_rules' && $con->lang == app()->getLocale())
						$postingRules = $con->value;
 					 if($con->key == 'posting_allowance' && $con->lang == app()->getLocale())
 					    $postingAllowance = $con->value;
			  }
	     @endphp

					<!--help-link-->
	                    <div class="help-link">
	                        <button data-toggle="modal" data-target="#posting-allowance"> {{__('Know your posting allowance')}}</button>
	                        <button data-toggle="modal" data-target="#posting-rules">{{__('See our posting rules')}}</button>
	                    </div><!--end-->

	                        <!-- The Modal -->
					    <div class="modal fade custom-modal posting-allowance-modal" id="posting-allowance">
					        <div class="modal-dialog modal-dialog-centered">
					            <div class="modal-content">
					            
					                <!-- Modal Header -->
					                <div class="modal-header">
					                    <h4 class="modal-title">{{__('Posting Allowance')}}</h4>
					                    <button type="button" class="close" data-dismiss="modal">&times;</button>
					                </div>
					                
					                <!-- Modal body -->
					                <div class="modal-body scroll">
					                    <div class="text">
					                        <div class="heading">
					                            <h2>{{__('Posting ads on kroykari')}}</h2>
					                            <p>@php echo $postingAllowance @endphp </p>
					                        </div>

					                        <div class="free-posting">
					                            <h2>{{__('Your free posting allowance each month')}}</h2>

					                            <ul>
					                            	@forelse($categories as $category)
						                                <li class="clearfix">
						                                    <h2>{{$category->title_name}}</h2>
						                                    <span>{{$category->posting_allowance}}</span>
						                                </li>
					                                @empty
					                                @endforelse
					                            </ul>

					                            <p class="support-mail">{{__('For more information, contact us at')}} 
					                                <a href="mailto:support@bikroy.com">support@kroykari.com</a>
					                            </p>
					                        </div>
					                    </div>
					                </div>                
					            </div>
					        </div>
					    </div><!--end-->

					    <!-- The Modal -->
					    <div class="modal fade custom-modal posting-allowance-modal" id="posting-rules">
					        <div class="modal-dialog modal-dialog-centered">
					            <div class="modal-content">
					            
					                <!-- Modal Header -->
					                <div class="modal-header">
					                    <h4 class="modal-title">{{__('Posting Rules')}}</h4>
					                    <button type="button" class="close" data-dismiss="modal">&times;</button>
					                </div>
					                
					                <!-- Modal body -->
					                <div class="modal-body">
					                    <div class="text">
					                        <div class="heading">
					                            <h2>{{__('All ads posted on kroykari.com must follow our rules')}}:</h2>
					                        </div>
                                            
                                            @php echo $postingRules @endphp 
					                       
					                    </div>
					                </div>                
					            </div>
					        </div>
					    </div><!--end-->
					    
				</div>
			</div>
		</div>
	</section> <!--end-->

	<div class="google-ads google-ads2">
		<div class="container">
			<img src="{{asset('frontend')}}/images/ad3.jpg" alt="google ad" class="img-fluid">
		</div>
	</div>
@endsection
@push('js')
 <script>
	    
		let subCategory = (subCategory) => {
	       let html   = '<ul>';
		      subCategory.map(function(item,index){
                html += '<li class="sub-category" data-id="'+item.id+'" data-name="'+item.title+'">';
				html +=   '<div class="leading">';
				html +=     '<div class="icon"><img src="'+item.image+'"></div>';
				html +=      '<div class="title">'+item.title+'</div>';
				html +=   '</div>'
				html += '</li>';
			  });
			   html += '</ul>';
		   return html;
		}

		let city = (city) => {
	        let html   = '<ul>';
				city.map(function(item,index){
                html += '<li class="city" data-id="'+item.id+'" data-name="'+item.title+'">';
				html +=   '<div class="leading">';
				html +=      '<div class="title">'+item.title+'</div>';
				html +=   '</div>'
				html +=   '<div class="trailing"><i class="fas fa-angle-right"></i></div>';
				html += '</li>';
			  });
			   html += '</ul>';
		   return html;
		}

		let area = (area) => {
	       let html   = '<ul>';
			    area.map(function(item,index){
                html += '<li class="area" data-id="'+item.id+'" data-name="'+item.title+'">';
				html +=   '<div class="leading">';
				html +=     '<div class="icon"><img src="'+item.image+'"></div>';
				html +=      '<div class="title">'+item.title+'</div>';
				html +=   '</div>'
				html += '</li>';
			  });
			   html += '</ul>';
		   return html;
		}


      //Get Sub-Category
      $('.main-category').on('click',function(e){
			e.preventDefault();
            $('.rightside-subheading').text('{{__('Select a Sub Category')}}');
			$(this).parents('ul').find('li').removeClass('active');
			$(this).addClass('active');
			let categoryId   = $(this).attr('data-id');
			let categoryName = $(this).attr('data-name');
			localStorage.setItem("category", categoryId);
			localStorage.setItem("category_name", categoryName);
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
				'type':'GET',
				'url' : "{{route('ajax.sub.category')}}" + '/' + categoryId,
			beforeSend: function() {

			},
			'success' : function(response){
                let html = '';
				if(response.status == 'success'){
					if(response.data.length > 0)
   					   html += subCategory(response.data);
				}
				if(response.status == 'failed'){
				}
				if(response.status == 'error'){
				}
				$('#rightside-list').html(html);
			},
			'error' : function(error){
				console.log(error);
			},
			complete: function() {

			},
			});
      });

	    //Get City
		$('body').on('click','.sub-category',function(e){
			e.preventDefault();
			$('.leftside-subheading').text('{{__('Select City Or Division')}}');
			$(this).parents('ul').find('li').removeClass('active');
			$(this).addClass('active');
			let subCategory = $(this).attr('data-id');
			let subCategoryName = $(this).attr('data-name');
			localStorage.setItem("sub_category", subCategory);
			localStorage.setItem("sub_category_name", subCategoryName);
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
				'type':'GET',
				'url' : "{{route('ajax.city')}}",
			beforeSend: function() {

			},
			'success' : function(response){
                let html = '';
				if(response.status == 'success'){
					$('.rightside-subheading').text('');
					if(response.data.length > 0)
   					   html += city(response.data);
				}
				if(response.status == 'failed'){
				}
				if(response.status == 'error'){
				}
				$('#rightside-list').html('');
				$('#leftside-list').html(html);
			},
			'error' : function(error){
				console.log(error);
			},
			complete: function() {

			},
			});
      });

	   //Get Area
		$('body').on('click','.city',function(e){
			e.preventDefault();
			$('.rightside-subheading').text('{{__('Select Area')}}');
			$(this).parents('ul').find('li').removeClass('active');
			$(this).addClass('active');
			let city = $(this).attr('data-id');
			let cityName = $(this).attr('data-name');
			localStorage.setItem("city", city);
			localStorage.setItem("city_name", cityName);
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
				'type':'GET',
				'url' : "{{route('ajax.city.area')}}" + '/' + city,
			beforeSend: function() {

			},
			'success' : function(response){
                let html = '';
				if(response.status == 'success'){
					if(response.data.length > 0)
   					   html += area(response.data);
				}
				if(response.status == 'failed'){
				}
				if(response.status == 'error'){
				}
				$('#rightside-list').html(html);
			},
			'error' : function(error){
				console.log(error);
			},
			complete: function() {

			},
			});
      });

	  $('body').on('click','.area',function(e){
		    e.preventDefault();
			$(this).parents('ul').find('li').removeClass('active');
			$(this).addClass('active');
			let area = $(this).attr('data-id');
			let areaName = $(this).attr('data-name');
			localStorage.setItem("area", area);
			localStorage.setItem("area_name", areaName);
			window.location.href = "{{route('ad.create')}}";
	  });

 </script>
@endpush