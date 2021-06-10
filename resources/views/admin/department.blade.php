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
	<h1 class="page-header">Manage Department <small></small></h1>
	<!-- end page-header -->



			<!-- begin panel-body -->
			<div class="card">
							<div class="card-header bg-black  text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">
								Add Department
							</div>
							<div id="collapseOne" class="collapse " data-parent="#accordion">
								<div class="card-body">
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label">Department Information</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<input type="text" id="txt_upt_id" name="" hidden>
												<div class="col-md-4">
													
													<label>Department Name</label>
													<input type="text" class="form-control" id="txt_dept" />
													
												</div>
												<div class="col-md-8">
													<label>Department Description</label>
													<input type="text" class="form-control" id="txt_dept_desc" />
												</div>
												
											</div>
										</div>
									</div>
									{{-- <div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label">Assign Employee</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<div class="col-md-12">
													@foreach($user as $val)
														<input type="checkbox" class="chk_user"  value="'{{$val->user_id}}'" name="emp">
														<label class="emp" for="emp">{{$val->user_fname}} {{$val->user_lname}}</label><br>
													@endforeach
												</div>
												
												
											</div>
										</div>
									</div> --}}
									
									<button class=" btn btn-success pull-right" style="align-self: right;" id="btn_add_dept">Submit</button>
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
					<h4 class="panel-title">Data Table - Default</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="70%">Department Information</th>
								<th width="30%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $val)
								<tr >
									<td style="padding: 10px; ">
										<p hidden>{{$val->department_id}}</p>
										<b style="margin-left: 20px; font-size: 15px">Department Name:</b>
										<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->department_name}}</a>
										<br>
										<b style="margin-left: 20px; font-size: 15px">Department Description:</b> 
										<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->department_desc}}</a>
										<br>
										<b style="margin-left: 20px; font-size: 15px">Created At:</b> 
										<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->created_at}}</a>
									</td>
									<td>
										<button class="btn btn-success btn_approve " >Assign User</button>
										<button class="btn btn-warning" id="btn_update">Update</button>
										{{-- <button class="btn btn-danger" id="btn_delete">Delete</button> --}}
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
	

		<div class="modal fade" id="modal-message">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="text" id="modal_dept_id" name="" hidden>
						<h3 id="department_name"></h3>
						<table id="tbl_user" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="70%">Employee Name</th>
									<th width="30%">Action</th>
								</tr>
							</thead>
							<tbody id="body_modal">





							</tbody>
						</table>
						<div class="div_emp"></div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success">Action</a>
					</div>
				</div>
			</div>
		</div>
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
	
	$("#data-table-default").on('click','.btn_approve',function(){
		 department_id = $(this).closest("tbody tr").find("p").text()
		 $("#department_name").text($(this).closest("tbody tr").find("a:eq(0)").text())
		 $("#modal_dept_id").val(department_id)
		 $("#modal-message").modal('show')
		 $.ajax({
                url:'{{route('selectEmployee')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'department_id':department_id
                  
                  
                  
                },
                success:function(data)
                {
                	$("#body_modal").empty()
                	console.log(data)
                	for(i=0; i<data.data.length; i++)
                	{
                		check = 0;
                		if(data.emp.length != 0){

	                		for(j=0;j<data.emp.length; j++)
	                		{
	                			if(data.data[i]['user_id'] == data.emp[j]['user_id'])
	                			{
	                				if(data.emp[j]['emp_department_is_active'] == 1){
	                					$("#body_modal").append('<tr ><td style="padding: 10px; "><p hidden></p><a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp '+data.data[i]['user_fname']+' '+data.data[i]['user_lname']+'</a></td><td><button class="btn btn-danger btn_approve" id=""  value="'+data.data[i]['user_id']+'">Remove</button></td></tr>')
	                					
	                				}
	                				else if(data.emp[j]['emp_department_is_active'] != 1){
	                					$("#body_modal").append('<tr ><td style="padding: 10px; "><p hidden></p><a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp '+data.data[i]['user_fname']+' '+data.data[i]['user_lname']+'</a></td><td><button class="btn btn-success btn_approve" id=""  value="'+data.data[i]['user_id']+'">Assign</button></td></tr>')
	                					
	                				}

	                				check = 1;
	                			}

	                			
	                		}
	                		if(check != 1)
	                		{
	                			$("#body_modal").append('<tr ><td style="padding: 10px; "><p hidden></p><a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp '+data.data[i]['user_fname']+' '+data.data[i]['user_lname']+'</a></td><td><button class="btn btn-success btn_approve" id=""  value="'+data.data[i]['user_id']+'">Assign</button></td></tr>')
	                		}
	                	}

	                	else{
	                		$("#body_modal").append('<tr ><td style="padding: 10px; "><p hidden></p><a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp '+data.data[i]['user_fname']+' '+data.data[i]['user_lname']+'</a></td><td><button class="btn btn-success btn_approve" id=""  value="'+data.data[i]['user_id']+'">Assign</button></td></tr>')
	                	}
                	}
					
                   
                }
            })  
	})

	$("#btn_update").on('click',function(){
		department_id = $(this).closest("tbody tr").find("p").text()
		$("#txt_upt_id").val(department_id)
		$.ajax({
            url:'{{route('getDept')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'department_id':department_id
              
              
              
            },
            success:function(data)
            {
               
            	$("#txt_dept").val(data.dept[0]['department_name'])
				$("#txt_dept_desc").val(data.dept[0]['department_desc'])
				$("#btn_add_dept").text('Update')
            }
        })  
	})


	$("#body_modal").on("click",'.btn_approve', function(){
		emp_id = $(this).val()
		// alert($(this).text())

		department_id = $("#modal_dept_id").val()
		if($(this).text() == 'Assign'){
			status = '1'
			$(this).removeClass('btn btn-success')
			$(this).addClass('btn btn-danger')
			$(this).text('Remove')
		}
		else{
			status = '0'
			$(this).removeClass('btn btn-danger')
			$(this).addClass('btn btn-success')
			$(this).text('Assign')
		}
		$.ajax({
            url:'{{route('assignEmp')}}',
            type:'POST',
            
            data: {
              "_token": "{{ csrf_token() }}"
              ,'emp_id':emp_id
              ,'department_id':department_id
              ,'status':status
              
              
              
            },
            success:function(data)
            {
              console.log(data)
               
            }
        })  

		
	});


	$("#btn_add_dept").on('click',function(){
		
		

		dept_name = 		$("#txt_dept").val()
		dept_desc = 		$("#txt_dept_desc").val()
		if($(this).text == 'Submit')
		{
		$.ajax({
                url:'{{route('insertDepartment')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'dept_name':dept_name
                  ,'dept_desc':dept_desc
                  
                  
                  
                },
                success:function(data)
                {
                	swal("Success! Department inserted successfully", {
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
        else{
        	$.ajax({
        	 url:'{{route('updateDepartment')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'dept_name':dept_name
                  ,'dept_desc':dept_desc
                  ,'dept_id':$("#txt_upt_id").val()
                  
                  
                },
                success:function(data)
                {
                	swal("Success! Department updated successfully", {
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