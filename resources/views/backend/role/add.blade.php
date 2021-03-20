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
											<a href="{{route('admin/role/index')}}">{{__('Group List')}}</a>
											<a href="javascript:void(0)">{{__('Update Group')}}</a>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								</div>
							</div>
						</div><!--END header-->

						<!--supplier-details-->
						<div class="supplier-profile-details Myuser-details">
              <form method="POST" action="{{ route('admin/role/store') }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                      <label>Title</label>
                      <input type="text" name="role" class="form-control" placeholder="Title" value="{{old('role')}}">
                        @if ($errors->has('role'))
                          <span class="help-block text-red">
                            <strong>{{ $errors->first('role') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>
                  {{-- <div class="col-md-12">
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                      <label>Group Desctiption</label>
                      <textarea name="description" class="form-control" placeholder="Deacription">{{old('description')}}</textarea>
                        @if ($errors->has('description'))
                          <span class="help-block text-red">
                            <strong>{{ $errors->first('description') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div> --}}
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Users</label>
                      <select name="users[]" class="form-control"  multiple>
                          <option value="">-- Select User --</option>
                          @foreach($data['users'] as $user)
                             <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-12">
                          <div class="form-group">
                            <h4>Premissions</h4>
                            {{-- <label>
                              <input type="checkbox" id="ckbCheckAll" />
                              Check All
                            </label> --}}
                          </div>
                        </div>
                      @foreach ($data['modules'] as $module)
                        <div class="col-md-3">
                          <h4>{{ $module->module_name }}</h4> 
                          <div class="scroll-div">
                            <div class="form-group">
                              @foreach ($module->permissions as $permission)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="permissions[]" value="{{$permission->id}}">{{$permission->permission_name}}
                                </label>
                              </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                     <button type="submit" class="btn btn-sm btn-theme">Create</button>
                  </div>
                  </div>
                </div>
              </form>
						</div><!--END supplier-details-->
					</div>
				</div>
@endsection
@push('css')
  <link href="{{asset('/')}}css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
  <script src="{{asset('/')}}js/select2.min.js"></script>
  <script>
      // In your Javascript (external .js resource or <script> tag)
      $(document).ready(function() {
          $('select[name="users[]"]').select2();
      });
  </script>
@endpush