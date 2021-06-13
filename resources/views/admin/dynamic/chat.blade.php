

@foreach($data as $val)
			
			@if($val->history_user_id != session('user'))
				<li class="media media-sm">
					<a class="media-left" href="javascript:;">
					   <img src="../assets/img/user/user-5.jpg" alt="" class="media-object rounded-corner" />
					</a>
					<div class="media-body">
						
						<p style="color: black;padding: 10px">{!!$val->ticket_details!!}</p>
						
						@foreach($file as $f)
							@if($f->file_upload_history_id == $val->history_id)
							<a class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}">{{$f->file_upload_name}}</a><br>
							@endif
						@endforeach
					   <p class="small text-muted" style="color: black;padding: 10px;margin-top: -30px">{{$val->created_at}}</p>
					</div>
				</li>
				
			@else
				 <li class="media media-sm">
                    <div class="media-body text-right">
                        <p style="color: black;padding: 10px">{!!$val->ticket_details!!}</p>
						
                        @foreach($file as $f)
							@if($f->file_upload_history_id == $val->history_id)
							<a class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}">{{$f->file_upload_name}}</a><br>
							@endif
						@endforeach
                      	<p class="small text-muted" style="color: black;padding: 10px;margin-top: -30px">{{$val->created_at}}</p>
                    </div>
                    <a class="media-right" href="javascript:;">
                        <img src="../assets/img/user/user-6.jpg" alt="" class="media-object rounded-corner" />
                    </a>
                </li>
				
			@endif
			@break
		@endforeach
        <!-- Reciever Message-->
        @foreach($data as $val)
			@if($val->history_status == 'user reply' || $val->history_status == 'admin reply' || $val->history_status == 'admin answer' )
            	@if($val->history_user_id != session('user'))
				<li class="media media-sm">
					<a class="media-left" href="javascript:;">
					   <img src="../assets/img/user/user-5.jpg" alt="" class="media-object rounded-corner" />
					</a>
					<div class="media-body">
						
						<p style="color: black;padding: 10px">{!!$val->response_issue!!}</p>
						
						@foreach($file as $f)
							@if($f->file_upload_history_id == $val->history_id)
							<a class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}">{{$f->file_upload_name}}</a><br>
							@endif
						@endforeach
					   <p class="small text-muted" style="color: black;padding: 10px;margin-top: -30px">{{$val->created_at}}</p>
					</div>
				</li>
			@else
				 <li class="media media-sm" >
                    <div class="media-body text-right">
                        <p style="color: black;padding: 10px">{!!$val->response_issue!!}</p>
						
						@foreach($file as $f)
							@if($f->file_upload_history_id == $val->history_id)
							<a class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}" >{{$f->file_upload_name}}</a><br>
							@endif
						@endforeach
                        <p class="small text-muted" style="color: black;padding: 10px;">{{$val->created_at}}</p>
                    </div>
                    <a class="media-right" href="javascript:;">
                        <img src="../assets/img/user/user-6.jpg" alt="" class="media-object rounded-corner" />
                    </a>
                </li>
			@endif
			@endif
			@if($val->history_status == 'transfer')
				<div class="media-body">
							<center><h5 >Transfered to {{$val->department_name}}</h5></center>
							<center><small class="">{{$val->created_at}}</small></center>
						</div>
				
			@endif
			@if($val->history_status == 'closed')
				
					<div class="media media-sm">
						
						<div class="media-body">
							<center><h5 >Ticket has been Closed</h5></center>
							<center><small class="">{{$val->created_at}}</small></center>
						</div>
						
					</div>
			@endif
			@if($val->history_status == 'Overdue')
				
					<div class="media media-sm">
						
						<div class="media-body">
							<center><h5 >Ticket has been flag as overdue by the system</h5></center>
							<center><small class="">{{$val->created_at}}</small></center>
						</div>
						
					</div>
			@endif
		@endforeach

<script type="text/javascript">
	@foreach($data as $val)
		$("#h5_status").text('{{$val->priority_name}}')
		@break
	@endforeach
</script>
