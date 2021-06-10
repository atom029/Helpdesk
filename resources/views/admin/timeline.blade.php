@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />

<link href="{{asset('assets/css/timeline.css')}}" rel="stylesheet" />
<link href="../assets/plugins/dropzone/min/dropzone.min.css" rel="stylesheet" />
<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="{{asset('assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<style type="text/css">
	#refresh_task{
		color: white;
	}

	#refresh{
		color: white;
	}
</style>
@endsection

@section('content')	



<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->
@if(session('is_admin') == 1 || session('is_agent'))
@include('admin.include.header')
@else
@include('user.include.header')
@endif
<!-- begin #content -->
<div id="content" class="content">
	
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Manage Ticket <small></small></h1>
	<!-- end page-header -->
	<div id="dze_info"></div>


	<div class="col-lg-12">
	        <!-- begin panel -->
	        <div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    @foreach($data as $val)
                    	<h4 class="panel-title">{{$val->ticket_summary}}</h4>
                    	@break
                    @endforeach
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                	<div  class="px-4 py-5 chat-box bg-white" id="scroll_x" style="overflow-y:scroll; height:500px; display:block;" onscroll="scroll()">
		                <ul class="media-list media-list-with-divider">
							<div id="refresh" onscroll="scroll()"></div>
						</ul>
					</div>
					<div class="col-lg-12" style="padding: 10px">
						<button class="btn"><i class="fa fa-paperclip"></i></button>
						<button class="btn"><i class="fa fa-arrow-alt-circle-right fa-flip-vertical"></i></button>
						<button class="btn"><i class="fa fa-times-circle"></i></button>
						<button class="btn"><i class="fa fa-plus-circle"></i></button>
					</div>
					<div class="col-lg-12 row">
						<form action="/" name="wysihtml5" method="POST" class="col-lg-10">
						<textarea class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="1"></textarea>
					</form>
					<button class="col-lg-2"><i class="fa fa-plus-circle"></i></button>	
					</div>
					
				</div>

				<!-- end panel-body -->
			</div>
	        <!-- end panel -->
		</div>

	
	 <div class="col-lg-12" >
			    	<!-- begin nav-tabs -->
					<ul class="nav nav-tabs">
						<li class="nav-items">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Tab 1</span>
								<span class="d-sm-block d-none">Chat</span>
							</a>
						</li>
						@if(session('is_admin') == '1' || session('is_agent') == '1')
						<li class="nav-items">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link ">
								<span class="d-sm-none">Tab 2</span>
								<span class="d-sm-block d-none">Task</span>
							</a>
						</li>
						@endif
					
					</ul>
					<!-- end nav-tabs -->
					<!-- begin tab-content -->
					<div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
							<!-- Chat Box-->
							<div class="col-12 px-0" >
								<div  class="px-4 py-5 chat-box bg-white" id="scroll_x" style="overflow-y:scroll; height:500px; display:block;" onscroll="scroll()">
									<!-- Sender Message-->

									<div id="refresh" onscroll="scroll()"></div>


   		

								</div>


								<div class="bg-white" style="border-top: solid">
									@foreach($data as $val)


									<div class="media media-sm" style="padding: 20px; padding-bottom: 0">

										<div class="media-body" style="padding: 10px">
											<input type="text" hidden value="{{$val->ticket_id}}" id="txt_ticket_id">
											<input type="text" hidden value="{{$val->ticket_user_id}}" id="txt_ticket_user_id">
											<input type="text" hidden value="{{$val->history_department}}" id="txt_history_department">
											@if($val->ticket_agent == session('user') || $val->ticket_agent == 0 || $val->ticket_user_id == session('user'))
											@if($val->ticket_status != 'closed')
											@if(session('is_admin') == '1' || session('is_agent') == '1')
											<button class="btn btn-success pull-right" id="btn_create_ticket">Create Ticket</button>
											<button class="btn btn-success pull-right"  style="margin-right: 10px" id="btn_transfer">Transfer</button>
											<button class="btn btn-success pull-right" style="margin-right: 10px" id="btn_closed">Close ticket</button>
											@endif

											@endif
											@if($val->ticket_status == 'closed')
											@if(session('is_admin') == '1' || session('is_agent') == '1' ||  $val->ticket_user_id == session('user'))
											<button class="btn btn-success pull-right" id="btn_reopen">Reopen</button>
											@endif
											@endif
											@endif
											<h5 class="media-heading">Ticket No.: {{$val->ticket_no}}</h5>
											<h5 class="media-heading" style="text-transform: capitalize;">Ticket Status: {{$val->ticket_status}}</h5>
											@if(session('is_admin') == '1')
											<h5 class="media-heading" style="text-transform: capitalize;">Priority: {{$val->priority_name}}</h5>
											@endif
										</div>
									</div>

									@if($val->ticket_status != 'closed')
										@if($val->ticket_agent == session('user') || $val->ticket_agent == 0 || $val->ticket_user_id == session('user'))
									<div>
										<form action="/" name="wysihtml5" class="wysihtml5" method="">
																
											<textarea class="textarea form-control" id="txt_reply" placeholder="Enter text ..." rows="5"></textarea>
											<button  type="button" class="btn btn-info btn-white pull-right" id="btn_submit" style="margin-top: 5px;"> <i class="fa fa-paper-plane"></i>Submit</button>
										</form>

									</div>
									<form action="{{ route('multifileupload') }}" enctype="multipart/form-data" class="dropzone" id="chatUpload" method="POST">
										@csrf
										 <div class="fallback">
										    <input name="file" type="file" multiple />
										  </div>
										<input type="text" name="ticket_id"  value="{{$val->ticket_id}}" hidden>
									</form>
										@endif

									@endif
									@break
									@endforeach
								</div>
								<!-- Typing area -->




							</div>
						</div>
						<!-- end tab-pane -->
						<!-- begin tab-pane -->
						@if(session('is_admin') == '1' || session('is_agent') == '1')
						<div class="tab-pane fade " id="default-tab-2">
								<div style="margin-bottom: 10px">
								<button class="btn btn-success">Add Task</button>
								</div>
								<div class="card">
									<div class="card-header bg-black  text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">
										Task List
									</div>
									<div id="collapseOne" class="collapse " data-parent="#accordion">
										<div class="card-body">
											<table id="tbl_task_unassigned" class="table table-striped table-bordered">
														<thead>
															<tr>
																
																<th class="text-nowrap">Task Information</th>
																<th class="text-nowrap" width="30%">Action</th>
															</tr>
														</thead>
														<tbody>
															@foreach($task as $val)
															<tr class="odd gradeX" id="{{$val->task_id}}">
																
																<td>
																	<p hidden>{{$val->task_id}}</p>
						
																	<b style="margin-left: 20px; font-size: 15px">Task Summary:</b> 
																	<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->task_summary}}</a>
																	<br>
																	<b style="margin-left: 20px; font-size: 15px">Task Details:</b> 
																	<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->task_details}}</a>
																	
																</td>
																<td>
																	<button class="btn btn-success" id="btn_add_task">Add</button>
																</td>
																
															</tr>
															@endforeach

														</tbody>
													</table>	
										</div>
													
											
									</div>
								</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-inverse">
												<!-- begin panel-heading -->
												<div class="panel-heading">
													
													<h4 class="panel-title">Assigned Task</h4>
												</div>
												<!-- end panel-heading -->
												<!-- begin panel-body -->
												<div class="panel-body">
													<table id="tbl_task_assigned" class="table table-striped table-bordered">
														<thead>
															<tr>
																
																<th class="text-nowrap">Task Information</th>
																<th class="text-nowrap" width="30%">Action</th>

															</tr>
														</thead>
														<tbody>
															@foreach($task_assigned as $val)
															<tr class="odd gradeX">
																<td>
																	<p hidden>{{$val->task_id}}</p>
						
																	<b style="margin-left: 20px; font-size: 15px">Task Summary:</b> 
																	<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->task_summary}}</a>
																	<br>
																	<b style="margin-left: 20px; font-size: 15px">Task Details:</b> 
																	<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->task_details}}</a>
																	
																</td>
																<td>
																	@if($val->is_done == 0)
																		<button class="btn btn-success" id="btn_done">View</button>
																	@else
																		<button class="btn btn-info"  disabled>Done</button>
																	@endif
																</td>
															</tr>

															@endforeach

														</tbody>
													</table>

													<!-- Task Chat -->

													<div class="col-12 px-0" id="chat_task" >
														<div  class="px-4 py-5 chat-box bg-white" id="scroll_task_x" style="overflow-y:scroll; height:500px; display:block;" onscroll="scroll()">
															<!-- Sender Message-->

															<div id="refresh_task" onscroll="scroll()"></div>


     		

														</div>


														<div class="bg-white" style="border-top: solid">
															@foreach($data as $val)


															<div class="media media-sm" style="padding: 20px; padding-bottom: 0">

																<div class="media-body" style="padding: 10px">
																	

																	@if($val->ticket_status != 'closed')
																	@if(session('is_admin') == '1' || session('is_agent') == '1')
																	<button class="btn btn-success pull-right" style="margin-right: 10px" id="">Close task</button>
																	@endif

																	@endif
																	@if($val->ticket_status == 'closed')
																	@if(session('is_admin') == '1' || session('is_agent') == '1')
																	<button class="btn btn-success pull-right">Reopen</button>
																	@endif

																	@endif
																	<h5 class="media-heading">Ticket No.: {{$val->ticket_no}}</h5>
																	<h5 class="media-heading" style="text-transform: capitalize;" id="h5_status">Ticket Status: </h5>
																	@if(session('is_admin') == '1')
																	
																	@endif
																</div>
															</div>

															@if($val->ticket_status != 'closed')





															{{-- <div class="input-group">

																<input id="txt_task_reply" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
																<div class="input-group-append">
																	<button  type="button" class="btn btn-link btn-white" id="btn_task_submit"> <i class="fa fa-paper-plane"></i></button>
																</div>
															</div> --}}
															<form action="/" name="wysihtml5" class="wysihtml5" method="">
																
																<textarea class="textarea form-control" id="txt_task_reply" placeholder="Enter text ..." rows="5"></textarea>
																<button  type="button" class="btn btn-info btn-white pull-right" id="btn_task_submit" style="margin-top: 5px;"> <i class="fa fa-paper-plane"></i>Submit</button>
															</form>

															<form action="{{ route('multifileupload') }}" enctype="multipart/form-data" class="dropzone" id="taskUpload" method="POST">
																@csrf
																<div class="fallback">
																	<input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />

																</div>
																<input type="text" name="ticket_id"  value="{{$val->ticket_id}}" hidden>
															</form>

															@endif
															@break
															@endforeach
														</div>
														<!-- Typing area -->
													</div>
													<!-- End Task Chat -->
												</div>
												<!-- end panel-body -->
											</div>
											<!-- end panel -->
										</div>
									
								</div>
						</div>
						@endif
						<!-- end tab-pane -->
					</div>
	</div>


	{{-- <div class="conts col-lg-12" style="position:absolute;">
	  <ul class="timeline">
	    <li class="active">Bacon</li>
	    <li>Rib</li>
	    <li>Rib</li>
	    <li>Sausage</li>

	  </ul>
	</div> --}}


	<div>
	
    
  </div>


	    {{-- <iframe id="frame_upload" style="height: 1200px; width: 800px;"></iframe> --}}
	   

	</div>

	 <div class="modal fade preview "  id="modal_transfer">
			<div class="modal-dialog " >
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Modal Dialog</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div col-lg-12>
							<label>Department</label>
							<select class="form-control" id="sel_department">
								@foreach($department as $val)
									<option value="{{$val->department_id}}">{{$val->department_name}}</option>
								@endforeach
							</select>
						</div>
						<br>
						<div col-lg-12>
							<label>Agent</label>
							<select class="form-control" id="sel_dept_user">
								
							</select>
                                
						</div>
					</div>
					 
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success" id="btn_modal_transfer">Transfer</a>
					</div>
				</div>
			</div>
		</div>

		 <div class="modal modal-message fade" id="modal_create">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Create Ticket</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
					
						 <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Topic</label>
                                <div class="col-md-6 sel_topic" >
                                    <select class="form-control"  id="topic_sel">
                                        @foreach($topic as $val)
                                            <option value="{{$val->topic_id}}">{{$val->topic_summary}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-10 div_agent" >
                                <label class="col-md-3 text-md-right col-form-label">Agent</label>
                                <div class="col-md-6 ">
                                    <select class="form-control sel_user" id="sel_user">
                                       
                                        
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Priority</label>
                                <div class="col-md-6 sel_topic" >
                                    <select class="form-control"  id="sel_priority">
                                        @foreach($priority as $val)
                                            <option value="{{$val->priority_id}}">{{$val->priority_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Issue Summary</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="Sample summary" class="form-control txt_summary">
                                </div>
                            </div>
                             

                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Ticket Details</label>
                                <div class="col-md-6">
                                    <form action="/" name="wysihtml5" class="wysihtml5" method="">
                                        
                                        <textarea class="textarea form-control txt_issue" id="create_txt_issue"  placeholder="Enter text ..." rows="5"></textarea>
                                      
                                    </form>
                                </div>
                            </div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-primary" id="btn_create">Submit</a>
					</div>
				</div>
			</div>
		</div>


@section('page-js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
	<script src="../assets/plugins/dropzone/min/dropzone.min.js"></script>
	<script src="../assets/plugins/highlight/highlight.common.js"></script>
	<script src="../assets/js/demo/render.highlight.js"></script>
	<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
	<script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
	<script src="{{asset('assets/js/demo/form-wysiwyg.demo.min.js')}}"></script>
<script>

    	$("#chat_task").hide()
    	// alert('{{session('is_agent')}}')
    @foreach ($data as $val)
    
	@if(($val->ticket_agent == session('user') || $val->ticket_agent == 0 ) && ($val->ticket_status != 'closed' ))
	var task = new Dropzone("#taskUpload", { 
		url: "{{ route('multifileupload') }}",
		autoProcessQueue: false,
		maxFiles: 3,
		timeout: 180000,
		maxFilesize: 50,
		addRemoveLinks: true,
		parallelUploads: 3,
		maxfilesexceeded: function(file) {
			this.removeAllFiles();
			this.addFile(file);
		},
		acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
		
	});

	var chat = new Dropzone("#chatUpload", { 
		url: "{{ route('multifileupload') }}",
		autoProcessQueue: false,
		maxFiles: 3,
		timeout: 180000,
		maxFilesize: 50,
		addRemoveLinks: true,
		parallelUploads: 3,
		maxfilesexceeded: function(file) {
			this.removeAllFiles();
			this.addFile(file);
		},
		acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
		
	});

	@endif
	@break
	@endforeach
	$('#btn_create').on('click',function(){
			department = $("#department").val()
			agent = $( "#sel_user" ).val()
            ticket_id = $("#txt_ticket_id").val()
            topic = $( ".sel_topic option:selected" ).val()
            priority = $( "#sel_priority option:selected" ).val()
            summary = $(".txt_summary").val()
            issue = $(".txt_issue").val()
            // alert(priority)
            $.ajax({
                url:'{{route('createSubTicket')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'topic':topic
                  ,'summary':summary
                  ,'issue':issue
                  ,'mainTicket': ticket_id
                  ,'department': department
                  ,'agent': agent
                  ,'priority': priority
                },
                success:function(data)
                {
                    swal("Success! Your ticket no: "+data.data+"", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                  console.log(data)
                   
                }
            })  
        });
	

	$("#tbl_task_unassigned").on('click','#btn_add_task',function(){
		ticket_id = $("#txt_ticket_id").val()
		task_id = $(this).closest("tbody tr").find("p").text();
		// alert(task_id)
		$('#'+task_id+'').hide()
		$.ajax({
            url:'{{route('assignTask')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'ticket_id':ticket_id
              ,'task_id':task_id
            },
            success:function(data)
            {
              console.log(data)
            }
        })  
		// alert(ticket_id)
	})


	$("#btn_closed").click(function(){
		ticket_id = $("#txt_ticket_id").val()
		history_dept = $("#txt_history_department").val()
		creator_user_id = $("#txt_ticket_user_id").val()
		$.ajax({
            url:'{{route('closedTicket')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'ticket_id':ticket_id
              ,'user_id':'{{session('user')}}'
              ,'history_dept':history_dept
              ,'creator_user_id':creator_user_id
            },
            success:function(data)
            {
              // window.location.reload()
            }
        })  
	})

	task_id = 0;
	$("#tbl_task_assigned").on('click','#btn_done',function(){
		ticket_id = $("#txt_ticket_id").val()

		task_id = $(this).closest("tbody tr").find("p").text();

		$(".task_id").val(task_id)
		// alert(task_id)
		
			setInterval(function(){
				var active_button = $('.nav-tabs li a.active').attr('href');
				if(active_button == '#default-tab-2')
				{
					$("#refresh_task").load('<?php echo url('/taskChat/') ?>/'+$("#txt_ticket_id").val()+'/'+task_id+'');
				}
			},1000);
		

        
      
		$('#chat_task').show()
	});

	$("#btn_transfer").click(function(){
		$("#modal_transfer").modal('show')
	})

	$("#sel_department").on('change',function(){
		dept_id = $(this).val()
		alert(dept_id)
		var url = '{{ route("dept_agent", ":id") }}';
    	url = url.replace(':id', dept_id);
		$.ajax({
            type:'get',
            url: url,
            
            
          
            success:function(data)
            {
            	$("#sel_dept_user").empty()
              for(i=0; i<data.user.length; i++)
              	if({{session('user')}} == data.user[i]['user_id'])
              		continue
              	else
              		$("#sel_dept_user").append('<option value='+data.user[i]['user_id']+'>'+data.user[i]['user_fname']+'</option>')
              }
              	
              
              
               
            
        })  
	});


	$("#btn_reopen").on('click',function(){
		ticket_id = $("#txt_ticket_id").val()

		var url = '{{ route("reopen", ":id") }}';
    	url = url.replace(':id', ticket_id);
		$.ajax({
            type:'get',
            url: url,
            
            
          
            success:function(data)
            {
            	console.log(data)
            	if(data.data == '1'){
            	swal("Success! Ticket has been reopened", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                }
                else
                {
                	swal("Error! Something went wrong", {
                          icon: "error",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                }
            }
              	
              
              
               
            
        })  
	});

	

	$("#btn_modal_transfer").click(function(){
		ticket_id = $("#txt_ticket_id").val()
		department = $("#sel_department").val()
		agent = $( "#sel_dept_user option:selected" ).val()
		history_dept = $("#txt_history_department").val()
		// alert(ticket_id)
		$.ajax({
            url:'{{route('transferDepartment')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'ticket_id':ticket_id
              ,'department':department
              ,'user_id':'{{session('user')}}'
              ,'history_dept':history_dept
              ,'agent': agent
              
            },
            success:function(data)
            {
              console.log(data)
              
               
            }
        })  
	});
	

	$("#btn_task_submit").click(function(){
		
		reply = $("#txt_task_reply").val()
		ticket_id = $("#txt_ticket_id").val()
		task = task_id
		// alert(task)
		// alert(creator_user_id)
		$.ajax({
            url:'{{route('insertTaskResponse')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'reply':reply
              ,'ticket_id':ticket_id
              ,'user_id':'{{session('user')}}'
              ,'task':task

              
            },
            success:function(data)
            {
            	console.log(data)
            	 Dropzone.forElement("#taskUpload").processQueue();
            	 taskUpload.removeAllFiles();
              // alert('{{session('history_id')}}')
              
              
               
            }
        })  
	 })
	$("#btn_submit").click(function(){
		
		reply = $("#txt_reply").val()
		ticket_id = $("#txt_ticket_id").val()
		history_dept = $("#txt_history_department").val()
		creator_user_id = $("#txt_ticket_user_id").val()
		// alert(ticket_id)
		$.ajax({
            url:'{{route('insertResponse')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'reply':reply
              ,'ticket_id':ticket_id
              ,'user_id':'{{session('user')}}'
              ,'history_dept':history_dept
              ,'creator_user_id':creator_user_id

              
            },
            success:function(data)
            {
              // alert(Dropzone.forElement(".dropzone").files.length)
              Dropzone.forElement("#chatUpload").processQueue();
              console.log(data)
              is_scroll = 0;
              $("#txt_reply").val('')
              // if(data['data'] == true){
              // 	$(".div_reply").append('<div class="media w-50 ml-auto mb-3"><div class="media-body"><div class=" rounded py-2 px-3 mb-2" style="background-color: gray"><p class="text-small mb-0 "  style="color: white">'+reply+'</p>	</div><p class="small text-muted">{{now()}}</p>	</div></div>')
              // 	$("#txt_reply").val('')
              // 	objDiv.scrollTop = objDiv.scrollHeight;
              // }
              // else{
              // 	alert('error')
              // }
              
               
            }
        })  
	})


	$("#topic_sel").on('change', function(){
		dept_id = $(this).val()
		alert(dept_id)
		var url = '{{ route("dept_agent", ":id") }}';
    	url = url.replace(':id', dept_id);
		$.ajax({
            type:'get',
            url: url,
            
            
          
            success:function(data)
            {
            	$('.div_agent').show()
            	$(".sel_user").empty()
              for(i=0; i<data.user.length; i++)
              	if({{session('user')}} == data.user[i]['user_id'])
              		continue
              	else
              		$("#sel_user").append('<option value='+data.user[i]['user_id']+'>'+data.user[i]['user_fname']+'</option>')
              }
              	
              
              
               
            
        })  
	});

	$("#btn_create_ticket").click(function(){
		$("#modal_create").modal('show')
	})

	var is_scroll = 0;


	$("#scroll_x").scroll(function(){
		is_scroll = 1;
		// alert('scroll')
	})

	$(document).ready(function() {
		$('#tbl_task_assigned').dataTable( {
	  "ordering": false
	} );
		$('#tbl_task_unassigned').dataTable( {
	  "ordering": false
	} );
		var active_button = $('.nav-tabs li a.active').attr('href');
			 console.log(active_button)
		count = 0;
		setInterval(function(){
			var active_button = $('.nav-tabs li a.active').attr('href');
			if(active_button == '#default-tab-1')
			{
				$("#refresh").load('<?php echo url('/chat/') ?>/'+$("#txt_ticket_id").val()+'');
				// alert(is_scroll)

				if(is_scroll == 0)
				{
					var objDiv = document.getElementById("scroll_x");
					objDiv.scrollTop = objDiv.scrollHeight+1;
				}
			}
		},1000);

		App.init();
		$('#txt_task_reply, #txt_reply', '#create_txt_issue').wysihtml5({
		  toolbar: {
		    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		    "emphasis": true, //Italics, bold, etc. Default true
		    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		    "html": false, //Button which allows you to edit the generated HTML. Default false
		    "link": true, //Button to insert a link. Default true
		    "image": false, //Button to insert an image. Default true,
		    "color": false, //Button to change color of font  
		    "blockquote": true, //Blockquote  
		    
		  }
		});
	});

</script>

<script type="text/javascript">
 
</script>
@endsection
@endsection