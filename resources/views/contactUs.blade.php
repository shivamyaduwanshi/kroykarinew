@extends('layouts.app')
@section('content')

  <section class="contactus-page padding-top">
    <div class="container">
		<div class="row">
            <div class="col-md-12">
				<div class="cts-heading">
				<h2>{{__('Help and Support')}} | {{__('Contact Us')}}</h2>
				<p>{{ __('We are here to help. Please contact us and we will make sure you get the Information you need') }}</p>
			</div>
			</div>
		</div>
        <form action="{{route('contact.mail')}}" method="post" id="contact-us-form">
             @csrf
            <div class="contactus-form">
                {{-- <div class="heading">
                    <h2>{{__('Contact us')}}</h2>
                </div> --}}
                <div class="form-group">
                    <input type="text" placeholder="Name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Email Address" name="email"  value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <textarea name="message" id="" rows="3" placeholder="Write here...">{{old('message')}}</textarea>
                </div>
                <div class="btns">
                    <button class="btn1">{{__('Submit')}}</button>
                </div>
            </div>
		</form>
		
		<div class="contact-number">
			<div class="call-us">
				<p><i class="fa fa-phone-alt" aria-hidden="true"></i> {{__('Call us') }} : <a href="tel:+8801833999485">+8801833999485</a></p>
			</div>

			<div class="live-chat"> 
				<p><i class="fa fa-comments" aria-hidden="true"></i> <a target="_blank" href="https://www.facebook.com/kroykari">Live Chat</a></p>
			</div>
		</div>

    </div>
  </section>
@endsection
@push('js')
 <script>
      //Create Form
      $('#contact-us-form').on('submit',function(e){
     	e.preventDefault();
			let form  = $(this);
 		    let data  = form.serialize();
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
				'type':'POST',
				'url' : form.attr('action'),
				'data' : data,
			beforeSend: function() {

			},
			'success' : function(response){
				  form.find('span.text-error').remove();
				if(response.status == 'success'){
                    form.find('input[name="name"]').val('');
                    form.find('input[name="email"]').val('');
                    form.find('textarea[name="message"]').val('');
   			      toastr.success(response.message);
				}
				if(response.status == 'failed'){
				   toastr.error(response.message);
				}
				if(response.status == 'error'){
				 $.each(response.errors, function (key, val) {
				    form.find('[name='+key+']').after('<span class="text-error">'+val+'</span>');
				 });
				}
			},
			'error' : function(error){
				console.log(error);
			},
			complete: function() {

			},
			});
      });
 </script>
@endpush