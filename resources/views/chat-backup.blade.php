@extends('layouts.app')
@section('content')
	
	
	<!--chat-page-->
	<section class="chat-box-section padding-top">
		<div class="container">
			<div class="inner-chat-box">
				<div class="row">
					<div class="col-md-4 mg-list">
						<!-- Nav tabs -->
						<div class="chat-list">
							<div class="same-bg chat-title">
								<h2>{{__('Message')}}</h2>
								<div class="searchbar">
									<i class="fas fa-search"></i>
									<input type="search" placeholder="Search here...">
								</div>
							</div>
							
							<!-- Nav tabs -->
							<div class="mCustomScrollbar">
								<ul class="nav nav-tabs" id="chat-users">
									
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-md-8 mg-details">
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="chat1" class="tab-pane fade in active show">
							   
								@if(empty(Request::get('sender_id')) || empty(Request::get('receiver_id')) || empty(Request::get('ad_id')))
								   <!--no message-->
									<div class="no-message-found">
										<div class="body">
											<h2>{{__('No conversation yet!')}}</h2>

											<img src="{{asset('public/frontend/images/chat.png')}}" alt="">
											<p>{{__('Click Chat on an ad  or post your own ad to start chatting')}}</p>

											<div class="btns">
												<a href="{{route('ads')}}">{{__('Browse ads')}}</a>
												<a href="{{route('add.ad')}}">{{__('Post an ad!')}}</a>
											</div>
										</div>
									</div>
									<!--end-->
								@endif

								<div class="chat-box">
									<!---single chat------->
									<div chat-box-heaere-user-id="{{Request::get('receiver_id')}}" chat-box-heaere-ad-id="{{Request::get('ad_id')}}" class="same-bg chat-box-header chatBox-title">
										<button class="m-backbtn">
											<i class="fas fa-chevron-left"></i>
										</button>
										<div class="chat-profile">
											<img class="ad-image" src="" class="img-responsive" alt="profile">
										</div>
										<div class="chat-details">
									        <span class="product-name"> <i class="fab fa-product-hunt"></i> <span class="title"></span></span>
											<p class="user-name"></p>
										</div>
									</div><!--end-->
									<div class="chatting">
										
										<div class="message-body">
											
										</div>
                                        
										<span class="is-typing"></span>
										<div class="msg-typing-box">
											<textarea id="message-box" placeholder="Type message..."></textarea>
											<button id="send-message" class="send-btn same-bg"><i class="fas fa-paper-plane"></i>Send</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!--chat-page-->

@endsection
@push('css')
 <style type="text/css">
 	.chat-box{
 		display: none;
 	}
 </style>
@endpush
@push('js')
  <script type="text/javascript" src="http://localhost:8000/socket.io/socket.io.js"></script>
  <script type="text/javascript">

     const baseUrl   = "{{url('/')}}";

  	 const sender_id = "{{auth::id()}}";

	 let scrollDownChat = function(){
	     var messageBody = document.querySelector('.message-body');
	     messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
	 }  

  	@if(Request::get('sender_id') && Request::get('receiver_id') && Request::get('ad_id'))
  		$('.chat-box').show();
  	@endif
   
    let ChatUser = (user) => {
	     	let tabId = user.chat_room_id;
		    let html = '';
				html += `<li id="tab-id-${tabId}" class="user-tab">`;
				html +=    '<a class="">';
		        html +=        '<div class="chats clearfix">';
				html +=            '<div class="chat-profile-wrapper">';
				html +=                '<div class="chat-profile">';
				html +=                   `<img src="${user.ad_image}" class="img-responsive" alt="${user.user_id}" />`;
				html +=                '</div>';
				html +=             '</div>';
				html +=             '<div class="chat-details preview-chat">';
				html +=                 '<div class="cd-title">';
			    html +=                     `<label class="user-name">${user.title}</label>`;
		        html +=                     `<span class="last-seen"> <i class="far fa-clock"></i><span class="last-msg-time">${user.time}</span></span>`;
	            html +=                 '</div>';
			    html +=                 `<p class="message">${user.message}</p>`;
                html +=            '</div>';
                html +=        '</div>';
                html +=     '</a>';
                html +=  '</li>';
				return html;
	}

	let chatBox = (data) => {

           let html = '';
		       if(data.receiver_id == sender_id)
  		         html += '<div class="sender-message clearfix">';
			   else
 	             html +=    '<div class="reciver-message clearfix">';
			   html +=         '<div class="chat-profile">';
		       html +=         '</div>';
			   html +=         '<div class="msg">';
			   html +=           `<p>${data.message}</p>`;
			   html +=           `<span class="msg-time">${data.message_time}</span>`;
			   html +=         '</div>';
			   html +=      '</div>';
			   html += '</div>';
               return html;
     }
   
    var tabUsers = [];

	             $.ajax({
                     'url' : baseUrl + '/api/get/chat/users?user_id=' + sender_id,
                     'success' : function(response) {
					    if(response.status){
						    let users = response.data.map(user => {
							   return ChatUser(user);
							})
							$('#chat-users').html(users);
						}
                     },
                     'error' : function(error){
                       console.log(error);
                     }
                 });

               
                 let getConversation = (sender_id,receiver_id,ad_id) => {
					     $.ajax({
		                     'url' : baseUrl + '/api/get/chat/conversation?sender_id='+sender_id+'&receiver_id='+receiver_id+'&ad_id='+ad_id,
		                     'success' : function(response){
							    if(response.status){
							    	$('.chat-box .title').text(response.user.title);
							    	$('.chat-box .user-name').text(response.user.user_name);
							    	$('.chat-box .ad-image').attr('src',response.user.ad_image);
								    let message = response.data.map(msg => {
									   return chatBox(msg);
									})
									$('.message-body').html(message);
									scrollDownChat();
								}
		                     },
		                     'error' : function(error){
		                       console.log(error);
		                     }
		                 });
                 }
    
                 @if(Request::get('receiver_id') && Request::get('ad_id'))
                       var receiver_id = "{{Request::get('receiver_id')}}";
                       var ad_id       = "{{Request::get('ad_id')}}";
                       getConversation(sender_id,receiver_id,ad_id);
                 @endif

                $('input[type="search"]').on('keyup',function(e){
					  e.preventDefault();
                       $.ajax({
		                 'url' : baseUrl + '/api/get/chat/users?user_id=' + "{{auth::id()}}" +"&search=" + e.target.value,
		                 'success' : function(response){

							console.log(response);
		                 
						    if(response.status){
							    let users = response.data.map(user => {
								   return ChatUser(user);
								})
								$('#chat-users').html(users);
							}
		                 },
		                 'error' : function(error){
		                   console.log(error);
		                 }
		             });

		        });
            
        	   const socket = io('http://localhost:8000');
               socket.emit('online',{user_id:sender_id});

			   $('body #message-box').on('keypress',function(e){
					let receiver_id = $('body .chat-box-header').attr('chat-box-heaere-user-id');
					let ad_id       = $('body .chat-box-header').attr('chat-box-heaere-ad-id');
					 let payload = {sender_id:sender_id,receiver_id:receiver_id ,ad_id:ad_id};
                     socket.emit('ontyping',payload);
			   });

			    socket.on('ontyping',function(data){
				  	 let user_id =	$('body .chat-box-header').attr('chat-box-heaere-user-id');
					 let ad_id   =	$('body .chat-box-header').attr('chat-box-heaere-ad-id');
                            
					 if(user_id == data.sender_id) {
   					    $('body .is-typing').text('Typing');
					 }
			   })

			   $('body #message-box').on('keyup',function(e){
					let receiver_id = $('body .chat-box-header').attr('chat-box-heaere-user-id');
					let ad_id       = $('body .chat-box-header').attr('chat-box-heaere-ad-id');
					 let payload = {sender_id:sender_id,receiver_id:receiver_id ,ad_id:ad_id};
                     socket.emit('offtyping',payload);
			   });

			  socket.on('offtyping',function(data){
				  	 let user_id =	$('body .chat-box-header').attr('chat-box-heaere-user-id');
					 let ad_id   =	$('body .chat-box-header').attr('chat-box-heaere-ad-id');
                            
					 if(user_id == data.sender_id) {
   					    $('body .is-typing').text('');
					 }
			   })

		        $('body').on('click','.user-tab',function(e){
					e.preventDefault();
					$('.no-message-found').remove();
		            let receiver_id = $(this).attr('data-user-id');
		            let ad_id       = $(this).attr('data-ad-id');
		                getConversation(sender_id,receiver_id,ad_id);
						var queryParams = new URLSearchParams(window.location.search);
						queryParams.set("sender_id", sender_id);
						queryParams.set("receiver_id", receiver_id);
						queryParams.set("ad_id", ad_id);
						history.replaceState(null, null, "?"+queryParams.toString());
						$('.chat-box').show();
						$('body .chat-box-header').attr('chat-box-heaere-user-id',receiver_id);
		                $('body .chat-box-header').attr('chat-box-heaere-ad-id',ad_id);
		        });

		          socket.on('receive',function(data){
						   
					let user = {
                                 'sender_id'     : data.sender_id,
                                 'receiver_id'   : data.receiver_id,
                                 'message'       : data.message,
                                 'message_time'  : data.time
                              };

						    let user_id     =	$('body .chat-box-header').attr('chat-box-heaere-user-id');
						    let ad_id       =	$('body .chat-box-header').attr('chat-box-heaere-ad-id');
                            
							if(user_id == data.sender_id) {
	                         	$('.message-body').append(chatBox(user));
							}

						$.ajax({
							'url' : baseUrl + '/api/get/chat/users?user_id={{auth::id()}}',
							'success' : function(response) {
							if(response.status){
								let users = response.data.map(user => {
									return ChatUser(user);
								})
								$('#chat-users').html(users);
							}
							},
							'error' : function(error){
							console.log(error);
							}
						});
				 
				  });
				

               	 $('body').on('click','#send-message',function(e){
				
				   		e.preventDefault();
				   		let msg = $('#message-box').val();
				   		if(msg != ''){
				   			  $('#message-box').val('');
							  let receiver_id =	$('body .chat-box-header').attr('chat-box-heaere-user-id');
							  let ad_id       =	$('body .chat-box-header').attr('chat-box-heaere-ad-id');
							  let payload = {sender_id:sender_id,receiver_id:receiver_id ,ad_id:ad_id,message:msg};
							  socket.emit('send',payload);
							  let time   = new Date();
                              let user = {
                                 'sender_id'     : sender_id,
                                 'receiver_id'   : receiver_id,
                                 'message'       : msg,
                                 'message_time'  : time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
                              };
							  $('.message-body').append(chatBox(user));
							  
							let chatRoomId  = ad_id + '-';
							var nums = [ sender_id , receiver_id ];
							chatRoomId  += Math.min.apply(Math, nums) + '-';
							chatRoomId  += Math.max.apply(Math, nums);
							tabId        = chatRoomId;

							 let UserTab = $('body #tab-id-' + tabId).clone(true);
							 $('body #tab-id-' + tabId).remove();
							 $('#chat-users').prepend(UserTab);
							 $('body #tab-id-' + tabId + ' .message').text(user.message);
							 $('body #tab-id-' + tabId + ' .last-msg-time').text(user.message_time);
							 scrollDownChat();
				   		}
				  });

			$('body').on('keyup','#message-box',function(e){
				if (event.keyCode != 13) {
					return false;
				}
				e.preventDefault();
				let msg = $('#message-box').val();
				if(msg != ''){
					  $('#message-box').val('');
				   let receiver_id =	$('body .chat-box-header').attr('chat-box-heaere-user-id');
				   let ad_id       =	$('body .chat-box-header').attr('chat-box-heaere-ad-id');
				   let payload = {sender_id:sender_id,receiver_id:receiver_id ,ad_id:ad_id,message:msg};
				   socket.emit('send',payload);
				   let time   = new Date();
				   let user = {
					  'sender_id'     : sender_id,
					  'receiver_id'   : receiver_id,
					  'message'       : msg,
					  'message_time'  : time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
				   };
				   $('.message-body').append(chatBox(user));
				   
				 let chatRoomId  = ad_id + '.';
				 var nums = [ sender_id , receiver_id ];
				 chatRoomId  += Math.min.apply(Math, nums) + '.';
				 chatRoomId  += Math.max.apply(Math, nums);
				 tabId        = chatRoomId.replaceAll('.', '-');
	 
			 let UserTab = $('body #tab-id-' + tabId).clone(true);
			 console.log(UserTab);
						   $('body #tab-id-' + tabId).remove();
				 $('#chat-users').prepend(UserTab);
				   $('body #tab-id-' + tabId + ' .message').text(user.message);
				   $('body #tab-id-' + tabId + ' .last-msg-time').text(user.message_time);
				 scrollDownChat();
				}
	   });

  </script>
@endpush
