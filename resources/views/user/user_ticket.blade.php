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