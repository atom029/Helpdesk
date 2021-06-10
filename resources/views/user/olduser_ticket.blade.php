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

@include('user.include.header')

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
									<select name="filter" class="form-cotrol" id="sel_sort">
										<option value="1">Priority</option>
										<option value="2">Date Created</option>
										<option value="3">Unread</option>
									</select>

									<table id="data-table-default" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th class="text-nowrap">Ticket Information</th>
											</tr>
											<tbody id="table_ticket">
												@foreach($ticket as $val)

												<tr>
													
													<td>
														@if($val->is_read_user != 0)
														<div class="">

															<div class="media-body">
																<div class="media-heading">

																	<a href="{{url('timeline') }}/ {{$val->ticket_id}}"  class="m-r-10">Ticket No.:{{$val->ticket_no}}</a>
																	@if(now() >= $val->ticket_date)
																	<span class="badge bg-red">Overdue</span>
																	@endif
																	<small class="float-right text-muted">{{$val->created_at}} </small>
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
																	<small class="float-right text-muted">{{$val->created_at}} </small>
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


			<!-- begin panel -->
			<div class="panel panel-inverse" hi>
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Ticket</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_ticket" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Ticket Information</th>
								<th class="text-nowrap">Action</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($ticket as $val)
							<tr>
							@if($val->is_read_user == 0)
								<td style="padding: 10px; background-color: #D3D3D3; " >
							@else
								<td style="padding: 10px; background-color: white" >
							@endif
									<p hidden>{{$val->ticket_id}}</p>

									<b style="margin-left: 20px; font-size: 15px">Topic:</b> 
									<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->topic_summary}}</a>
									<br>
									<b style="margin-left: 20px; font-size: 15px">Ticket No:</b> 
									<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->ticket_no}}</a>
									<br>
									<b style="margin-left: 20px; font-size: 15px">Ticket Description:</b> 
									<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->ticket_summary}}</a>
									<br>
									<b style="margin-left: 20px; font-size: 15px">Created: </b> 
									<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->created_at}}</a>
									<br>
									<b style="margin-left: 20px; font-size: 15px">Status: </b> 
									<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->ticket_status}}</a>
								</td>
								@if($val->is_read_user == 0)
								<td style="padding: 10px; background-color: #D3D3D3; ">
							@else
								<td style="padding: 10px; background-color: white" >
							@endif
									<button class="btn btn-success btn_approve" id="">View</button>
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
	
	$("#tbl_ticket").on('click','.btn_approve',function(){
		 // alert($(this).closest("tbody tr").find("p").text())
		 location.href = '{{url('timeline') }}/ '+ $(this).closest("tbody tr").find("p").text()+''

	})

	
	

	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		
	});
</script>
@endsection
@endsection