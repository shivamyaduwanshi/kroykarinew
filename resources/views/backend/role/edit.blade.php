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
              <form method="POST" action="{{ route('admin/role/update',$data['role']->id) }}">
                {{ csrf_field() }}
                {{method_field('put')}}
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="role" class="form-control" placeholder="title" value="{{old('role') ?? $data['role']->role_title}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Users</label>
                      <select name="users[]" class="form-control" multiple>
                          <option value="">-- Select User --</option>
                          @foreach($data['users'] as $user)
                             <option @if($user->role_id == $data['role']->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
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
                            {{-- <label> <input type="checkbox" id="ckbCheckAll" />
                            Check All</label> --}}
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
                                  <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                @isset ($data['role'])
                                    @foreach ($data['role']->permissions as $role_permit)
                                      @if ($role_permit->id == $permission->id)
                                        checked
                                      @endif 
                                   @endforeach
                                @endisset
                              >{{$permission->permission_name}}
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
                        @can('delete' , App\Models\Role::class)
                           <button type="submit" class="btn btn-sm btn-theme">Update</button>
                        @endcan
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
          @if(!Auth::user()->can('delete',App\Models\Role::class))
             $('input,select').attr('disabled','disabled');
          @endif
      });
  </script>
@endpush

