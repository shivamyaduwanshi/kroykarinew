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
											<a href="{{route('admin.cities')}}">{{__('City List')}}</a>
											<a href="javascript:void(0)">{{__('Add City')}}</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
							<form action="{{route('admin.city.store')}}" method="post">
								@csrf
								<div class="row">
									<!--supplier profile-->
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="profile-details">
											<div class="row">
												<div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
                                                            <select class="form-control" name="type">
                                                            	<option @if(old('type') == 'city') selected @endif value="city">{{__('City')}}</option>
                                                            	<option @if(old('type') == 'division') selected @endif value="division">{{__('Division')}}</option>
                                                            </select>
															@if ($errors->has('type'))
															   <span class="text-error">{{ $errors->first('type') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
														   <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="{{old('title_en')}}" >
															@if ($errors->has('english_title'))
															   <span class="text-error">{{ $errors->first('english_title') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="input-details">
														<div class="form-group">
															<input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="{{old('title_bn')}}" >
															@if ($errors->has('bangla_title'))
															   <span class="text-error">{{ $errors->first('bangla_title') }}</span>
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

