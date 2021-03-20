		@forelse($data['city']->areas as $key => $area)
		@if(!is_null($area->delete_at))
		  @php continue @endphp
		@endif
			<div class="profile-details">
				<label class="btn-dlt-wrapper">
					<i class="fa fa-trash btn-dlt" data-parent-city-id="{{$data['city']->id}}" data-url="{{ route('admin.area.remove',$area->id)}}"></i>
				</label>
			<form action="{{route('admin.area.update')}}" method="POST" class="update-area-form">
				@csrf
				<input type="hidden" name="city_id" value="{{$area->id}}">
				<input type="hidden" name="city_id" value="{{$data['city']->id}}">
				<div class="row">
					<div class="col-md-6">
						<div class="input-details">
							<div class="form-group">
							   <input class="form-control" type="text" placeholder="{{__('title in english')}}" name="english_title" value="{{$area->title}}" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-details">
							<div class="form-group">
								<input class="form-control" type="text" placeholder="{{__('title in bangla')}}" name="bangla_title" value="{{$area->title_bn}}" readonly>
							</div>
						</div>
					</div>
				</div>
				<div class="btn-wrapper">
					<button class="btn-theme btn-edit">{{__('Edit')}}</button>
					    <button style="display: none;" class="btn-theme btn-reset">{{__('Reset')}}</button>
					<input style="display: none;"type="submit" class="btn-theme btn-update" value="{{__('Update')}}">
				</div>
			</form>
		</div>
		@empty
		@endforelse