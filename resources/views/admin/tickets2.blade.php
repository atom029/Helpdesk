@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
	<h1 class="page-header">Manage Ticket <small></small></h1>
	<!-- end page-header -->

	<!-- begin col-6 -->
			    <div class="col-lg-12 secret" >
			    	<!-- begin nav-tabs -->
					<ul class="nav nav-tabs">
						<li class="nav-items">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								Assigned
							</a>
						</li>
						<li class="nav-items">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link">
								Unassigned
							</a>
						</li>
					
					</ul>
					<!-- end nav-tabs -->
					<!-- begin tab-content -->
					<div class="tab-content" id="TabContainer">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
							<!-- begin panel -->
							<div class="panel panel-inverse">
								<!-- begin panel-heading -->
								<div class="panel-heading">
									<div class="panel-heading-btn">

									</div>
									<h4 class="panel-title">Tickets</h4>
								</div>
								<!-- end panel-heading -->
								<!-- begin panel-body -->
								<div class="panel-body">

									<label for="filter">Sort by:</label>
									<select name="filter" class="form-cotrol sel_sort" id="">
										<option value="1">Priority</option>
										<option value="2">Date Created</option>
										<option value="3">Unread</option>
									</select>

									<table id="datatable" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th width="10%">Priority</th>
												<th class="text-nowrap">Ticket Information</th>
											</tr>
											
										</table>
									</div>
									<!-- end panel-body -->
								</div>
							</div>
						<!-- end tab-pane -->
						<!-- begin tab-pane -->
						<div class="tab-pane fade" id="default-tab-2">
														<div class="panel panel-inverse">
								<!-- begin panel-heading -->
								<div class="panel-heading">
									<div class="panel-heading-btn">
										
									</div>
									<h4 class="panel-title">Tickets</h4>
								</div>
								<!-- end panel-heading -->
								<!-- begin panel-body -->
								<div class="panel-body">

									<label for="filter">Sort by:</label>
									<select name="filter" class="form-cotrol sel_sort" id="">
										<option value="1">Priority</option>
										<option value="2">Date Created</option>
										<option value="3">Unread</option>
									</select>
									
									<table id="data-table-unAssigned" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th width="10%">Priority</th>
												<th class="text-nowrap">Ticket Information</th>

											</tr>
											<tbody id="table_ticket">
												@foreach($unAssigned as $val)
												
												<tr>
													<td>
														@for($i = 0 ; $i< $val->ticket_priority ; $i++)
														<span class="fa fa-star checked"></span>
														@endfor
													</td>
													<td>
														@if($val->is_read_admin != 0)
														<div class="">

															<div class="media-body">
																<div class="media-heading">

																	<a href="{{url('timeline') }}/ {{$val->ticket_id}}"  class="m-r-10">Ticket No.:{{$val->ticket_no}}</a>
																	@if(now() >= $val->ticket_date)
																	<span class="badge bg-red">Overdue</span>
																	@endif
																	<small class="float-right text-muted">{{date('d-m-Y', strtotime($val->ticket_created_at))}}</small>
																</div>
																<p class="msg">{{$val->ticket_summary}}</p>   
															</div>
														</div>
														@else
														<div class="">

															<div class="media-body">
																<div class="media-heading">
																	<a href="{{url('timeline') }}/ {{$val->ticket_id}}"  class="m-r-10">Ticket No.:{{$val->ticket_no}}</a>
																	@if(now() >= $val->ticket_date)
																	<span class="badge bg-red">Overdue</span>
																	@endif
																	<span class="badge bg-amber">Unread</span>
																	<small class="float-right text-muted">{{date('d-m-Y', strtotime($val->ticket_created_at))}}</small>
																</div>
																<p class="msg">{{$val->ticket_summary}}</p>                                
															</div>
														</div>
														@endif
													</td>
												</tr>

												@endforeach
												
											</tbody>
										</table>
									</div>
									<!-- end panel-body -->
								</div>
							</div>
						<!-- end tab-pane -->
						<!-- begin tab-pane -->
					
						<!-- end tab-pane -->
					</div>
	

			<div class="modal fade preview" id="modal-dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Modal Dialog</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							
						</div>
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


<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	

	$('#data-table-unAssigned').dataTable( {
	  "ordering": false
	} );

	$("#tbl_ticket").on('click','.btn_approve',function(){
		 // alert($(this).closest("tbody tr").find("p").text())
		 location.href = '{{url('timeline') }}/ '+ $(this).closest("tbody tr").find("p").text()+''

	})

	
	function getTab()
	{
		alert('getting tab')
		if($('.nav-tabs .active').attr('href') == '#default-tab-2')
		{
			{{session(['ticket_tab' => '2'])}}
			alert('tab {{session('ticket_tab')}}')
		}
		else if($('.nav-tabs .active').attr('href') == '#default-tab-1')
		{
			{{session(['ticket_tab' => '1'])}}
			alert('tab {{session('ticket_tab')}}')
		}
	}

	$(".sel_sort").on('change',function(){
	
		sort = $(this).val()
		

		
		if(sort == 1 ){

			location.href = '{{url('tickets')}}'
		}
		else if(sort == 2){
			// alert('2')
			location.href = '{{url('tickets/date')}}'
		}
		else if(sort == 3){
			location.href = '{{url('tickets/unread')}}'
		}
	})

	

	

	$(document).ready(function() {
		
		$('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('serverTicket') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "ticket_summary" },
                { "data": "ticket_no" }
            ]	 

        });
	
		@if($data == 'date')
			$(".sel_sort").val("2");
		@elseif($data == 'unread')
			$(".sel_sort").val("3");
		@elseif($data == 'priority')
			$(".sel_sort").val("1");
		@endif
		App.init();
		// TableManageDefault.init();
		
	});


</script>
@endsection
@endsection