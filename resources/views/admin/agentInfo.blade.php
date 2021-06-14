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
	<h1 class="page-header">Manage Agent <small></small></h1>
	<!-- end page-header -->
	<div id="dze_info"></div>

	<div class="row">
		<div class="col-lg-8">
		 	<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Agent</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th hidden></th>
								<th>Agent Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $val)
								<tr >
									<td hidden>{{$val->user_id}}</td>
									<td>{{$val->user_fname}} {{$val->user_lname}} </td>
									@if($val->is_online == 1)
										<td><span class="badge bg-green ">Online</span> </td>
									@else
										<td><span class="badge bg-gray ">Offline</span> </td>
									@endif
									<td>
										<button class="btn btn-success btn_edit " >Edit</button>
										<button class="btn btn-warning" id="btn_update">View</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
		</div>
		
		<div class="col-lg-4" >
			<div id="accordion" class="card-accordion">
				<div class="card">
					<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseInfo">
						Add Agent
					</div>
					<div id="collapseInfo" class="collapse show" data-parent="#accordion" >
						<div class="card-body">
							<div class="panel-body">
								@foreach($data as $val)
									<input type="text" hidden value="" id="txt_ticket_id">
									<div class="row">
										<div class="col-lg-12">
											<div class="row">
												<label>First Name</label>
												<input type="text" class="form-control" id="fname" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<label>Middle Name</label>
												<input type="text" class="form-control" id="mname" />


											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<label>Last Name</label>
												<input type="text" class="form-control" id="lname" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
												<label>Email</label>
												<input type="text" class="form-control" id="email" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">

												<label>Contact No</label>
												<input type="text" class="form-control" id="contact_no" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">

												<label>Username</label>
												<input type="text" class="form-control " id="username" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">

												<label>Password</label>
												<input type="text" class="form-control " id="password" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">

												<label>Confirm Password</label>
												<input type="text" class="form-control " id="password2" />
											</div>
										</div>
										
										<div class="col-lg-12" style="margin-top: 10px">
												<button class="btn btn-success float-right" id="btn_add_agent">Add Agent</button>
												<button class="btn btn-danger float-right" id="btn_cancel_edit" style="margin-right: 5px">Cancel</button>
										</div>
									</div>
									
									@break
								@endforeach
							</div>
						</div>
					</div>
					<!-- begin card -->
				
				</div>
			</div>
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
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
	});

	$("#btn_edit").on('click',function(){
		agent_id = $(this).closest("tbody tr").find("td:eq(1)").html()
		$("#fname").val()
		$("#mname").val()
		$("#lname").val()
		$("#email").val()
		$("#contact_no").val()
		$("#username").val()
	})


	$("#btn_add_agent").on('click',function(){
		
		chk_agent = 1
		
		

		fname = 		$("#fname").val()
		mname = 		$("#mname").val()
		lname = 		$("#lname").val()
		email = 		$("#email").val()
		contact_no = 	$("#contact_no").val()
		chk_admin = 	$("#chk_admin").val()
		
		username = 		$("#username").val()
		password = 		$("#password").val()
		$.ajax({
                url:'{{route('insertUser')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'fname':fname
                  ,'mname':mname
                  ,'lname':lname
                  ,'email':email
                  ,'contact_no':contact_no
                  ,'is_admin':0
                  ,'is_agent':chk_agent
                  ,'username':username
                  ,'password':password
                  ,'is_active':'1'
                  ,'is_approve':'1'
                  
                  
                },
                success:function(data)
                {
                	swal("Success! User inserted successfully", {
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

</script>

@endsection
@endsection