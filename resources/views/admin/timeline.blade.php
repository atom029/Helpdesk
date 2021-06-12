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

	<div class="row">
		<div class="col-lg-8">
		        <!-- begin panel -->
		        <div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
	                <!-- begin panel-heading -->
	                <div class="panel-heading">
	                   
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
							
							
							@if($val->ticket_status != 'closed')
							<button class="btn btn-info" id="btn_transfer" title="Transfer Ticket"><i class="fa fa-arrow-alt-circle-right fa-flip-vertical"></i></button>
							<button class="btn btn-danger" id="btn_closed" title="Closed Ticket"><i class="fa fa-times-circle"></i></button>
							<button class="btn btn-success" id="btn_create_ticket" title="Create Ticket"><i class="fa fa-plus-circle"></i></button>


						</div>
						<div class="input-group mb-3">
						  
						  <textarea type="text" class="form-control" id="txt_reply" rows="3"></textarea>
						  <div class="input-group-prepend">
						    <button class="fa fa-paper-plane" type="button" id="btn_submit" ></button>
						  </div>
						</div>
						<form action="{{ route('multifileupload') }}" enctype="multipart/form-data" class="dropzone" id="chatUpload" method="POST" >
							@csrf
							 <div class="fallback">
							    <input name="file" type="file" multiple />
							  </div>
							<input type="text" name="ticket_id"  value="{{$val->ticket_id}}" hidden>
						</form>
						@elseif($val->ticket_status == 'closed')
						<button class="btn btn-success" id="btn_reopen" title="Reopen Ticket"><i class="fa fa-lock-open"></i></button>
						@endif
					</div>

					<!-- end panel-body -->
				</div>
		        <!-- end panel -->
		</div>
		
		<div class="col-lg-4" >
			<div id="accordion" class="card-accordion">
				<div class="card">
					<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseInfo">
						Ticket Information
					</div>
					<div id="collapseInfo" class="collapse show" data-parent="#accordion" >
						<div class="card-body">
							<div class="panel-body">
								@foreach($data as $val)
									<input type="text" hidden value="{{$val->ticket_id}}" id="txt_ticket_id">
									<div class="row">
										<div class="col-lg-12">
											<div class="row">
												<h5>Ticket No:</h5>
												<p>&nbsp &nbsp {{$val->ticket_no}}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<h5>Status:</h5>
												<p>&nbsp &nbsp {{$val->history_status}}</p>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="row">
												<h5>Email:</h5>
												<p>&nbsp &nbsp {{$val->user_email}}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<h5>Priority:</h5>
												<p id="p_priority">&nbsp &nbsp {{$val->ticket_priority}}</p>
												<select id="sel_update_priority" class="form-control">
													@foreach($priority as $prio)
														
														<option  value="{{$prio->priority_id}}">{{$prio->priority_name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<h5>Summary:</h5>
												<p id="p_summary">&nbsp &nbsp {{$val->ticket_summary}}</p>
												<input type="text" name=""  id="txt_update_summary" class="form-control" placeholder="{{$val->ticket_summary}}">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<h5>Topic:</h5>
												<p id="p_topic">&nbsp &nbsp {{$val->topic_summary}}</p>
												<select id="sel_update_topic" class="form-control">
													@foreach($topic as $row)
														
														<option  value="{{$row->topic_id}}">{{$row->topic_summary}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-12" style="margin-top: 10px">
												<button class="btn btn-success float-right" id="btn_edit">Edit Ticket</button>
												<button class="btn btn-danger float-right" id="btn_cancel_edit" style="margin-right: 5px">Cancel</button>
										</div>
									</div>
									
									@break
								@endforeach
							</div>
						</div>
					</div>
					<!-- begin card -->
				<div class="card">
					<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseOne">
						Ticket History
					</div>
					<div id="collapseOne" class="collapse " data-parent="#accordion" >
						<div class="card-body" style="overflow-y:scroll; height:500px;"  onscroll="scroll()">
							<div class="panel-body">
								@foreach($history as $val)
								@if($val->history_status == 'open')
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/new-ticket.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">Ticket Created</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@elseif($val->history_status == 'admin answer' || $val->history_status == 'admin reply')
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/answered.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">Admin Reply</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@elseif($val->history_status == 'user reply' )
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/user-answered.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">User Reply</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@elseif($val->history_status == 'closed')
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/ticket-closed.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">Ticket Closed</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@elseif($val->history_status == 'Overdue')
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/ticket-overdue.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">Ticket Overdue</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@elseif($val->history_status == 'transfer')
								<div class="media media-sm">
									<a class="media-left" href="javascript:;">
										<img src="../assets/img/user/ticket-transfer.png" alt="" class="media-object img-thumbnail" style="height: 50px; width:50px" />
									</a>
									<div class="media-body">
										<h5 class="media-heading">Ticket Transfered</h5>
										<p>{{$val->created_at}}</p>
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseTwo">
							Task
						</div>
						<div id="collapseTwo" class="collapse" data-parent="#accordion">
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
					<div class="card">
						<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseThree">
							Task Assigned
						</div>
						<div id="collapseThree" class="collapse" data-parent="#accordion">
							<div class="card-body">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
											<button class="btn btn-success pull-right" id="">Create Ticket</button>
											<button class="btn btn-success pull-right"  style="margin-right: 10px" id="">Transfer</button>
											<button class="btn btn-success pull-right" style="margin-right: 10px" id="">Close ticket</button>
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
																
											<textarea class="textarea form-control" id="" placeholder="Enter text ..." rows="5"></textarea>
											<button  type="button" class="btn btn-info btn-white pull-right" id="" style="margin-top: 5px;"> <i class="fa fa-paper-plane"></i>Submit</button>
										</form>

									</div>
									
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
    $("#txt_update_summary").hide()
	$("#sel_update_priority").hide()
	$("#btn_cancel_edit").hide()
	$("#sel_update_topic").hide()
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
              Dropzone.forElement("#chatUpload").removeAllFiles(true);
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
		document.getElementById("p_priority").innerHTML = "&nbsp&nbsp" + $("#sel_update_priority option[value="+$("#p_priority").text().trim()+"]").text();
		$("#p_priority").text()
		$("#p_priority option:contains("+$("#p_priority").text().trim()+")").attr('selected', 'selected');
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

	$("#btn_edit").on('click', function(){
		
		if($("#btn_edit").text() == "Edit Ticket"){
			$("#txt_update_summary").val($("#p_summary").text().trim())
			$("#btn_edit").text("Update")
			$("#btn_cancel_edit").show()
			$("#p_summary").hide()
			$("#p_priority").hide()
			$("#p_topic").hide()
			$("#txt_update_summary").show()
			$("#sel_update_priority").show()
			$("#sel_update_topic").show()
			$("#sel_update_priority option:contains("+$("#p_priority").text().trim()+")").attr('selected', 'selected');
			$("#sel_update_topic option:contains("+$("#p_topic").text().trim()+")").attr('selected', 'selected');
			
		}
		else{
			if($("#txt_update_summary").val().trim() ==	$("#p_summary").text().trim() && $( "#sel_update_priority option:selected" ).text().trim() ==	$("#p_priority").text().trim() && $( "#sel_update_topic option:selected" ).text().trim() == $("#p_topic").text().trim())
			{
				alert('same')
			}
			else
			{
				topic = ''
				if($( "#sel_update_topic option:selected" ).text() == $("#p_topic").text())
					topic = 0
				else 
					topic = $("#sel_update_topic").val()
				alert($("#sel_update_topic").val())
				$.ajax({
		            url:'{{route('updateTicket')}}',
		            type:'POST',
		            
		            data: {
		              "_token": "{{ csrf_token() }}"
		              ,'summary':$("#txt_update_summary").val()
		              ,'ticket_id':$("#txt_ticket_id").val()
		              ,'priority':$("#sel_update_priority").val()
		              ,'topic':topic



		              
		            },
		            success:function(data)
		            {
		              alert("asd")
		            }
		        })
   			}  
		}

	});

	$("#btn_cancel_edit").on('click', function(){
		$("#btn_edit").text("Edit Ticket")
		$("#p_summary").show()
		$("#btn_cancel_edit").hide()
		$("#p_priority").show()
		$("#p_topic").show()
		$("#txt_update_summary").hide()
		$("#sel_update_priority").hide()
		$("#sel_update_topic").hide()
	});

</script>

<script type="text/javascript">
 
</script>
@endsection
@endsection