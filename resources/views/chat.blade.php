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
							   
								@if(empty(Request::get('chatroomid')))
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
									<div id="chat-box-header"></div>
									<div class="chatting">
										<div class="message-body"></div>
										<div class="msg-typing-box">
											<textarea id="message-box" placeholder="{{__('Type message...')}}"></textarea>
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
  <script type="text/javascript">
       const baseUrl    = "{{url('/')}}";
	   const sender_id  = "{{auth::id()}}";
	   const chatRoomId = "{{Request::get('chatroomid') ?? NULL}}";
	   const chatData   = {};
	socket.emit('online',{user_id:sender_id});

	 let scrollDownChat = function(){
	     var messageBody = document.querySelector('.message-body');
	     messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
	 }  

  	@if(Request::get('chatroomid'))
  		$('.chat-box').show();
  	@endif
   
    let ChatUser = (data) => {
	     	let tabId = data.chat_room_id;
		    let html = '';
				html += `<li id="${tabId}" class="user-tab"`;
				html +=    '<a class="">';
		        html +=        '<div class="chats clearfix">';
				html +=            '<div class="chat-profile-wrapper">';
				html +=                '<div class="chat-profile">';
				html +=                   `<img src="${data.ad_image}" class="img-responsive" alt="${data.title}" />`;
				html +=                '</div>';
				html +=             '</div>';
				html +=             '<div class="chat-details preview-chat">';
				html +=                 '<div class="cd-title">';
				html +=						'<div class="title-count">';
				html +=                     	`<label class="user-name">${data.title}</label>`;
				html +=							`<span class="count">${data.unread_msg}</span></span>`;
				html +=                     	`<span class="last-seen"> <i class="far fa-clock"></i><span class="last-msg-time">${data.time}</span></span>`;
				html +=						'</div>';
	            html +=                 '</div>';
			    html +=                 `<p class="message">${data.message}</p>`;
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

			let chatBoxReceiver = (message,time) => {
					let html = '';
  			  	    html += '<div class="sender-message clearfix">';
					html +=         '<div class="chat-profile">';
					html +=         '</div>';
					html +=         '<div class="msg">';
					html +=           `<p>${message}</p>`;
					html +=           `<span class="msg-time">${time}</span>`;
					html +=         '</div>';
					html +=      '</div>';
					html += '</div>';
					return html;
	   	    }
	 
	 let chatBoxHeader = (data) => {
		let html = '';
			html += '<div class="same-bg chatBox-title">';
				html += '<button class="m-backbtn">';
				html += '	<i class="fas fa-chevron-left"></i>';
				html += '</button>';
				html += '<div class="chat-profile">';
				html +=   `<img class="ad-image" src="${data.ad_image}" class="img-responsive" alt="profile">`;
				html += '</div>';
				html += '<div class="chat-details">';
				html += 	`<span class="product-name"> <span class="title"><i class="fab fa-product-hunt"></i> ${data.title}</span></span>`;
				html += 	`<p class="user-name">${data.user_name}</p>`;
				html += '</div>';
			html += '</div>';
		return html;
	 }
   
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

				 @if(Request::get('chatroomid'))
                   
					$.ajax({
						'url' : baseUrl + '/api/chat/user?user_id=' + sender_id + '&chat_room_id=' + chatRoomId,
						'success' : function(response) {
							if(response.status){
								socket.emit('readmsg',{chat_room_id:response.data.chat_room_id});
								html = chatBoxHeader(response.data)
								chatData.sender_id   = response.data.sender_id;
								chatData.receiver_id = response.data.receiver_id;
								chatData.ad_id       = response.data.ad_id;
								chatData.chat_room_id  = response.data.chat_room_id;
								chatData.ad_image      = response.data.ad_image;
								chatData.title         = response.data.title;
								$('#chat-box-header').html(html);
								getConversation(response.data.sender_id,response.data.receiver_id,response.data.ad_id);
							}
						},
						'error' : function(error){
						console.log(error);
						}
					});

				 @endif

                $('input[type="search"]').on('keyup',function(e){
					  e.preventDefault();
                       $.ajax({
		                 'url' : baseUrl + '/api/get/chat/users?user_id=' + "{{auth::id()}}" +"&search=" + e.target.value,
		                 'success' : function(response){
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

		        $('body').on('click','.user-tab',function(e){
					e.preventDefault();
					$('.no-message-found').remove();
					   let chatRoomId = $(this).attr('id');
					   $.ajax({
						'url' : baseUrl + '/api/chat/user?user_id=' + sender_id + '&chat_room_id=' + chatRoomId,
						'success' : function(response) {
							if(response.status){
								socket.emit('readmsg',{chat_room_id:response.data.chat_room_id});
								html = chatBoxHeader(response.data)
								chatData.sender_id   = response.data.sender_id;
								chatData.receiver_id = response.data.receiver_id;
								chatData.ad_id       = response.data.ad_id;
								chatData.chat_room_id  = response.data.chat_room_id;
								chatData.ad_image      = response.data.ad_image;
								chatData.title         = response.data.title;
								$('body #' + response.data.chat_room_id).find('.count').text('0');
								$('#chat-box-header').html(html);
								getConversation(response.data.sender_id,response.data.receiver_id,response.data.ad_id);
								var queryParams = new URLSearchParams(window.location.search);
								queryParams.set("chatroomid", response.data.chat_room_id);
								history.replaceState(null, null, "?"+queryParams.toString());
								$('.chat-box').show();
							}
						},
						'error' : function(error){
						console.log(error);
						}
					});

		        });

		          socket.on('receive',function(data){
					         console.log(data);
							 if(chatData.chat_room_id == data.chat_room_id){
								  $('.message-body').append(chatBoxReceiver(data.message,data.time));
								  socket.emit('readmsg',{chat_room_id:data.chat_room_id});
								  $('body #' + response.data.chat_room_id).find('.count').text('0');
							 }
							$('body #' + data.chat_room_id).remove();
							$('#chat-users').prepend(ChatUser(data));
							scrollDownChat();
				  });
				

				  $('body').on('click','#send-message',function(e){
						e.preventDefault();
						let msg = $('#message-box').val();
						if(msg != ''){
								$('#message-box').val('');
								chatData.message = msg;
								let time   = new Date();
								chatData.message_time = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
								chatData.time         = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
								socket.emit('send',chatData);
								$('.message-body').append(chatBox(chatData));
								$('body #' + chatData.chat_room_id).remove();
								chatData.unread_msg = 0;
								$('#chat-users').prepend(ChatUser(chatData));
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
							chatData.message = msg;
							let time   = new Date();
							chatData.message_time = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
							chatData.time         = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
							socket.emit('send',chatData);
							$('.message-body').append(chatBox(chatData));
							$('body #' + chatData.chat_room_id).remove();
							$('#chat-users').prepend(ChatUser(chatData));
							scrollDownChat();
					}
			 });

  </script>
@endpush
