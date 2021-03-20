@if($data['ad'])
										<!---single chat------->
										<div id="current-user-{{$data['ad']['user_id']}} current-ad-{{$data['ad']['ad_id']}}" class="same-bg chatBox-title">
											<button class="m-backbtn">
												<i class="fas fa-chevron-left"></i>
											</button>
											<div class="chat-profile">
												<img src="{{$data['ad']['image']}}" class="img-responsive" alt="profile">
											</div>
											<div class="chat-details">
												<p class="user-name">{{$data['ad']['title']}}</p>
												<span>{{$data['ad']['title'] ? __('Online') : __('Offline')  }}</span>
											</div>
										</div><!--end-->
										<div class="chatting">
											{{-- <div class="hr-line">
												<span class="msg-day">Today</span>
											</div> --}}
											
											<div class="mCustomScrollbar message-body">

												@forelse($data['chats'] as $chat)
												   @php $chat = (object) $chat @endphp

												        @if($chat->is_send == '1')
															<!----single message------>
															<div class="sender-message clearfix">
															<div class="msg">
																	<p>{{$chat->message}}</p>
																	<span class="msg-time">{{$chat->time}}</span>
																</div>
															</div> <!--end-->
														@endif
	                                                     @if($chat->is_send == '0')
															<!----single message------>
															<div class="reciver-message clearfix">
																<div class="msg">
																	<p>{{$chat->message}}</p>
																	<span class="msg-time">{{$chat->time}}</span>
																</div>
															</div> <!--end-->
	                                                     @endif
												@empty
												@endforelse
											</div>

											<div class="msg-typing-box">
												<textarea id="message-box" placeholder="{{__('Type message...')}}"></textarea>
												<button class="send-btn same-bg" id="send-message"><i class="fas fa-paper-plane"></i>{{__('Send')}}</button>
											</div>
										</div>
									@endif