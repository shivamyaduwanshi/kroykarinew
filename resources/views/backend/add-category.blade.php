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
											<a href="{{route('admin.categories')}}">{{__('Category List')}}</a>
											<a href="Myuser-details.html">{{__('Add Category')}}</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<form action="{{route('admin.store.category')}}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<!--supplier profile-->
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="profile-details">
											<div class="row">
												<div class="col-md-6">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="{{old('title_en')}}" >
															@if ($errors->has('english_title'))
															   <span class="text-error">{{ $errors->first('english_title') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-details">
														<div class="form-group">
															<input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="{{old('title_bn')}}" >
															@if ($errors->has('bangla_title'))
															   <span class="text-error">{{ $errors->first('bangla_title') }}</span>
															@endif
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
													<div class="input-details">
														<div class="form-group">
															<input class="form-control" type="number" placeholder="{{__('Free posting allowance each month')}}" name="posting_allowance" value="{{old('posting_allowance')}}" >
															@if ($errors->has('posting_allowance'))
															   <span class="text-error">{{ $errors->first('posting_allowance') }}</span>
															@endif
														</div>
													</div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-details">
                                                        <div class="custom-upload-img">
                                                            {{-- <span class="edit"><i class="fas fa-pencil-alt"></i></span> --}}
                                                            <label>
                                                                <img onerror="profileImgError(this)" src="{{asset('backend/images/upload-image.png')}}">
                                                                <input type="file" name="image" accept="image/*">
                                                                @if ($errors->has('image'))
                                                                    <span class="text-error">{{ $errors->first('image') }}</span>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn-theme" style="margin: 0;" >{{__('Add')}}</button>
                                                </div>
											</div>
										</div>
									</div><!--END supplier profile-->
								</div>
							</form>
						</div><!--END supplier-details-->
					</div>
				</div>
@endsection
@push('css')
 <style type="text/css">
 </style>
@endpush
@push('js')
 <script type="text/javascript">
 	   //Image Preview
      $('input[type="file"]').on('change',function(event){
      // event.preventDefault();
       tmppath = URL.createObjectURL(event.target.files[0]);
       $('.custom-upload-img img').attr('src',tmppath);
      });
 </script>
@endpush

