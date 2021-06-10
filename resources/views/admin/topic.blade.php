@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />

<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('content')	



<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

@include('admin.include.header')

<!-- begin #content -->
<div id="content" class="content">
	
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Manage Topic <small></small></h1>
	<!-- end page-header -->



			<!-- begin panel-body -->
			<div class="card">
							<div class="card-header bg-black  text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">
								Add Topic
							</div>
							<div id="collapseOne" class="collapse " data-parent="#accordion">
								<div class="card-body">
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label">Topic Information</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<input type="text" id="txt_upt_topic" name="" hidden="">
												<div class="col-md-4">
													
													<label>Topic</label>
													<input type="text" class="form-control" id="txt_topic" />
													
												</div>
												<div class="col-md-4">
													<label>Priority</label>
													<select id="sel_type" class="form-control">
														<option value="1">Low</option>
														<option value="2">Normal</option>
														<option value="3">High</option>
													</select>
												</div>
												<div class="col-md-4">
													<label>Department</label>
													<select id="sel_department" class="form-control">
														@foreach($data as $val)
															<option value="{{$val->department_id}}">{{$val->department_name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label">Ticket Assign</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<div class="col-md-4">
													
													<label>Automatic</label>
													<input type="radio" class=" "name="radio" id="auto_assign" checked="checked"/>
													<label>Manual</label>
													<input type="radio" class=" "name="radio" id="manual_assign" />
													
												</div>
												<div class="col-md-4">
													
												</div>
												
											</div>
										</div>
									</div>
									
									<button class=" btn btn-success pull-right" style="align-self: right;" id="btn_add_topic">Submit</button>
									<div class="row text-right col-lg-12" >
										
										
									</div>

								</div>
								
								
							</div>
						</div>
			<!-- end panel-body -->
		

	
	<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Topic</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_topic" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="70%">Topic Information</th>
								<th width="30%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($topic as $val)
								<tr >
									<td style="padding: 10px; ">
										<p hidden>{{$val->topic_id}}</p>
										<b style="margin-left: 20px; font-size: 15px">Topic:</b>
										<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->topic_summary}}</a>
										<br>
										<b style="margin-left: 20px; font-size: 15px">Priority:</b> 
										<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->priority_name}}</a>
										<br>
										<b style="margin-left: 20px; font-size: 15px">Department:</b> 
										<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->department_name}}</a>
									</td>
									<td>
										<button class="btn btn-warning btn_update" id="">Update</button>
										<button class="btn btn-danger btn_delete">Delete</button>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->


</div>







@section('page-js')
<!-- ================== BEGIN PAGE LEVEL JS ================== --> 
<script src="{{asset('assets/js/qrcode.min.js')}}"></script>

<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	
	$("#tbl_topic").on('click','.btn_update',function(){
		 topic = $(this).closest("tbody tr").find("p").text()
		 $("#txt_upt_topic").val(topic)
		 $.ajax({
                url:'{{route('getTopic')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'topic':topic
                  
                  
                },
                success:function(data)
                {
                	$('#sel_department').val(data.data[0]['department_id']);
                    $("#txt_topic").val(data.data[0]['topic_summary'])
					$("#sel_type").val(data.data[0]['priority_id'])
					$("#btn_add_topic").text("Update")
					if(data.data[0]['auto_assign'] == 1)
					
						$("#auto_assign").prop("checked", true);
					
					else
						$("#manual_assign").prop("checked", true);
                }
            })  
	})

	$("#tbl_topic").on('click','.btn_delete',function(){
		 topic = $(this).closest("tbody tr").find("p").text()


		  swal({
		      title: "Are you sure?",
		      text: "This topic will be deleted!",
		      icon: "warning",
		      buttons: [
		        'No',
		        'Yes'
		      ],
		      dangerMode: true,
		    }).then(function(isConfirm) {
		      if (isConfirm) {
		       	 $.ajax({
                url:'{{route('deleteTopic')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'topic':topic
                  
                  
                },
                success:function(data)
                {
                	swal("Success! Topic deleted successfully", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                 }
            })  
		      } 
		      else {
		        swal("Cancelled", "Topic has not been deleted.", "error");
		      }
		    })

		
	})
	$("#btn_add_topic").on('click',function(){
		
		
		if(document.getElementById('auto_assign').checked)
		{
			auto_assign = 1;

		}
		else
		{
			auto_assign = 0;
		}
		topic = 		$("#txt_topic").val()
		priority = 		$("#sel_type").val()
		department = 		$("#sel_department").val()
		if($(this).text() == "Submit"){
			$.ajax({
                url:'{{route('insertTopic')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'topic':topic
                  ,'priority':priority
                  ,'department':department
                  ,'type':'public'
                  ,'is_active':'1'
  				  ,'auto_assign':auto_assign
                  
                  
                },
                success:function(data)
                {
                	swal("Success! Topic inserted successfully", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                  // console.log(data)
                   
                }
            })  
		}
		else{
			$.ajax({
                url:'{{route('updateTopic')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                   ,'topic':topic
                  ,'priority':priority
                  ,'department':department
                  ,'topic_id':$("#txt_upt_topic").val()
                 
  				  ,'auto_assign':auto_assign
                  
                  
                },
                success:function(data)
                {
                	swal("Success! Topic updated successfully", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                  console.log(data)
                   
                }
            })  
		}
	});

	

	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
	});
</script>
@endsection
@endsection