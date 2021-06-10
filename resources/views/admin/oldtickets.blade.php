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
	<h1 class="page-header">Manage Ticket <small></small></h1>
	<!-- end page-header -->


		

	<!-- begin panel -->
			<div class="panel panel-inverse">
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
					<div class="col-md-9">
						<label for="filter">Sort by:</label>
						<select name="filter" class="form-cotrol" id="sel_sort">
							<option value="1">Priority</option>
							<option value="2">Date Created</option>
							<option value="3">Unread</option>
						</select>
					</div>
					<table id="tbl_ticket" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Ticket Information</th>
								<th class="text-nowrap">Action</th>
								
							</tr>
						</thead>
						<tbody id="table_ticket">
							@foreach($ticket as $val)
							
						<tr  >
							@if($val->is_read_admin == 0)
								<td style="padding: 10px; background-color: #D3D3D3; " >
							@else
								<td style="padding: 10px; background-color: white" >
							@endif
								<p hidden>{{$val->ticket_id}}</p>
						
								<b style="margin-left: 20px; font-size: 15px">Ticket No:</b> 
								<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->ticket_no}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Name:</b>
								<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->user_fname}} {{$val->user_lname}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Email:</b> 
								<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->user_email}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Topic:</b> 
								<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->topic_summary}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Priority:</b> 
								<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->priority_name}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Ticket Description:</b> 
								<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->ticket_summary}}</a>
								
								{{-- @if($val->ticket_date < $date) --}}
								<br>
								<b style="margin-left: 20px; font-size: 15px">Overdue:</b> 
								<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->ticket_date}}</a>
								{{-- @endif --}}
								</b>
								
							</td>

							@if($val->is_read_admin == 0)
								<td style="padding: 10px; background-color: #D3D3D3;" >
							@else
								<td style="padding: 10px; background-color: white" >
							@endif
								<button class="btn btn-success btn_approve" id="">View</button>
								{{-- <button class="btn btn-danger">Deny</button> --}}
							</td>
						</tr>
						
					@endforeach
							
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
	<!-- end panel -->

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




	$("#sel_sort").on('change',function(){
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

		@if($data == 'date')
			$("#sel_sort").val("2");
		@elseif($data == 'unread')
			$("#sel_sort").val("3");
		@elseif($data == 'priority')
			$("#sel_sort").val("1");
		@endif
		App.init();
		TableManageDefault.init();
		
	});
</script>
@endsection
@endsection