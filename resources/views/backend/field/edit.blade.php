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
											<a href="javascript:void(0)">Edit Field ({{ ucFirst($field->name) }})</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<form action="{{route('admin.field.update',$field->id)}}" method="post">
                                @csrf
                                @method('PUT')
								<div class="row">
									<!--supplier profile-->
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="profile-details">
											<div class="row">
                                                <div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="text" placeholder="Field name" name="name" value="{{old('name') ?? $field->name }}" >
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
                                                                 <option @if($field->type == 'text') selected @endif value="text">Text</option>
                                                                 <option @if($field->type == 'select') selected @endif value="select">Select</option>
                                                                 <option @if($field->type == 'checkbox') selected @endif value="checkbox">Checkbox</option>
                                                                 <option @if($field->type == 'radio') selected @endif value="radio">Radio</option>
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
														   <input class="form-control" type="option" placeholder="Add Option" value="{{ old('option') ?? $opt }}" name="option" class="form-control" value="{{old('option')}}" >
															@if ($errors->has('option'))
															   <span class="text-error">{{ $errors->first('option') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											@can('update' , App\Models\Field::class)
											<button class="btn-theme">Update</button>
											@endcan
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
	@if($field->type == 'text')
	   $('.option-wrapper').hide();
	@endif
	@if(old('type') != '' && old('type') != 'text')
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
	      @if(!Auth::user()->can('update',App\Models\Field::class))
             $('input,select').attr('disabled','disabled');
          @endif
 </script>
@endpush
