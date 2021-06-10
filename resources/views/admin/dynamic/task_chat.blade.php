

@foreach($data as $val)
			
			@if($val->history_user_id != session('user'))
				<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
					<div class="media-body ml-3">
						<div class="bg-light rounded py-2 px-3 mb-2">
							<p class="text-small mb-0 ">{!!$val->task_details!!}</p>
						</div>
						<p class="small text-muted">{{$val->created_at}}</p>
						<hr>
					</div>
				</div>
			@else
				<div class="media w-50 ml-auto mb-3">
					<div class="media-body">
						<div class="bg-primary rounded py-2 px-3 mb-2" >
							<p class="text-small mb-0" style="color: white">{!!$val->task_details!!}</p>
						</div>
						<p class="small text-muted">{{$val->created_at}}</p>
						<hr>
					</div>
				</div>
			@endif
			@break
		@endforeach
        <!-- Reciever Message-->
        @foreach($data as $val)
			@if($val->history_status == 'task answer')
            	@if($val->history_user_id != session('user'))
				<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
					<div class="media-body ml-3">
						<div class="bg-light rounded py-2 px-3 mb-2">
							<p class="text-small mb-0 ">{!!$val->response_issue!!}</p>
							@foreach($file as $f)
								@if($f->file_upload_history_id == $val->history_id)
								<a class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}">{{$f->file_upload_name}}</a><br>
								@endif
							@endforeach
						</div>
						<p class="small text-muted">{{$val->created_at}}</p>
					</div>
				</div>
			@else
				<div class="media w-50 ml-auto mb-3">
					<div class="media-body">
						<div class=" rounded py-2 px-3 mb-2" style="background-color: gray">
							<p class="text-small mb-0 "  style="color: white">{!!$val->response_issue!!}</p>
							@foreach($file as $f)
								@if($f->file_upload_history_id == $val->history_id)
								<a  style="color: #14DAFF" class="upl_file" href="{{asset('upload')}}/{{session('user')}}/{{$f->file_upload_ticket_id}}/{{$f->file_upload_name}}">
									{{$f->file_upload_name}}</a><br>
								@endif
							@endforeach
						</div>
						<p class="small text-muted">{{$val->created_at}}</p>
					</div>
				</div>
				@endif
			@endif
			
		@endforeach
<script type="text/javascript">
	@foreach($data as $val)
	$("#h5_status").text('{{$val->task_summary}}')
		@break
	@endforeach
</script>