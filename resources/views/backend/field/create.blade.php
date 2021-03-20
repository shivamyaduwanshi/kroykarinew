@extends('backend.layouts.loggedInApp')
@section('content')
				<div class="main-body">
                    @include('backend.common.alert')
					<div class="inner-body">
						<!--header-->
						<div class="header">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="title">
										<!-- <h2>My Tenders</h2> -->
										<p class="navigation">
											<a href="{{route('admin.field.index')}}">Field List</a>
											<a href="javascript:void(0)">Create Field</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<form action="{{route('admin.field.store')}}" method="post">
								@csrf
								<div class="row">
									<!--supplier profile-->
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="profile-details">
											<div class="row">
                                                <div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="text" placeholder="Field name" name="name" value="{{old('name')}}" >
															@if ($errors->has('name'))
															   <span class="text-error">{{ $errors->first('name') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
                                                            <select class="form-control" name="type">
                                                                 <option value="">Select type</option>
                                                                 <option @if(old('type') == 'text') selected @endif value="text">Text</option>
                                                                 <option @if(old('type') == 'select') selected @endif value="select">Select</option>
                                                                 <option @if(old('type') == 'checkbox') selected @endif value="checkbox">Checkbox</option>
                                                                 <option @if(old('type') == 'radio') selected @endif value="radio">Radio</option>
                                                            </select>
															@if ($errors->has('type'))
															   <span class="text-error">{{ $errors->first('type') }}</span>
															@endif
														</div>
													</div>
                                                </div>
                                                <div class="col-md-8 option-wrapper">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="option" placeholder="Field option" name="option" class="form-control" value="{{old('option')}}" >
															@if ($errors->has('option'))
															   <span class="text-error">{{ $errors->first('option') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											<button class="btn-theme">{{__('Add')}}</button>
										</div>
									</div><!--END supplier profile-->
								</div>
							</form>
						</div><!--END supplier-details-->
					</div>
				</div>
@endsection
@push('css')
 <link href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}" />
@endpush
@push('js')
 <script src="{{asset('public/backend/js/bootstrap-tagsinput.js')}}"></script>
 <script>
    $('input[name="option"]').tagsinput('items');
    $('.option-wrapper').hide();
	@if(old('type') != 'text')
   	$('.option-wrapper').show();
	@endif
	$('select[name="type"]').on('change',function(e){
		 var type = $(this).val();
		 if(type == 'text'){
              $('.option-wrapper').hide();
		 }else{
  			  $('.option-wrapper').show();
		 }
	});
 </script>
@endpush
