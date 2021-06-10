@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
	<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')	
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
@include('admin.include.header')
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-content-full-height">
		
		
		
		 
		<!-- begin #content -->
		<div id="content" class="content content-full-width inbox">
		    <!-- begin vertical-box -->
		    <div class="vertical-box with-grid">
		        <!-- begin vertical-box-column -->
		        <div class="vertical-box-column width-200 bg-silver hidden-xs">
		        	<!-- begin vertical-box -->
		        	<div class="vertical-box">
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
									<!-- begin scrollbar -->
									<div data-scrollbar="true" data-height="100%">
										<!-- begin wrapper -->
										<div class="wrapper p-0">
											<div class="nav-title"><b>FOLDERS</b></div>
											<ul class="nav nav-inbox">
												<li class="active"><a href="email_inbox.html"><i class="fa fa-inbox fa-fw m-r-5"></i> Assigned <span class="badge pull-right">{{count($assigned)}}</span></a></li>
												<li><a href="email_inbox.html"><i class="fa fa-flag fa-fw m-r-5"></i> Unassigned <span class="badge pull-right">{{count($unAssigned)}}</span></a></li>
												{{-- <li><a href="email_inbox.html"><i class="fa fa-envelope fa-fw m-r-5"></i> Sent</a></li>
												<li><a href="email_inbox.html"><i class="fa fa-pencil-alt fa-fw m-r-5"></i> Drafts</a></li>
												<li><a href="email_inbox.html"><i class="fa fa-trash fa-fw m-r-5"></i> Trash</a></li> --}}
											</ul>
											<div class="nav-title"><b>Topic</b></div>
											<ul class="nav nav-inbox">
												<li class="active liMenuTopic"><a href="javascript:;" class="menuTopic"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-primary"></i> View all</a></li>
												@foreach($topic as $row)
												<li class="liMenuTopic"><a href="javascript:;" class="menuTopic"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-primary"></i> {{$row->topic_summary}}</a></li>
												@endforeach
												{{-- <li><a href="javascript:;"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-success"></i> Staff</a></li>
												<li><a href="javascript:;"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-warning"></i> Sponsorer</a></li>
												<li><a href="javascript:;"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-danger"></i> Client</a></li> --}}
											</ul>
										</div>
										<!-- end wrapper -->
									</div>
									<!-- end scrollbar -->
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
					</div>
					<!-- end vertical-box -->
		        </div>
		        <!-- end vertical-box-column -->
		        <!-- begin vertical-box-column -->
		        <div class="vertical-box-column bg-white">
		        	<!-- begin vertical-box -->
		        	<div class="vertical-box">
						<!-- begin wrapper -->
						<div class="wrapper bg-silver-lighter">
							<!-- begin btn-toolbar -->
							<div class="btn-toolbar">
								<div class="btn-group m-r-5">
									<a href="javascript:;" class="p-t-5 pull-left m-r-3 m-t-2" data-click="email-select-all">
										<i class="far fa-square fa-fw text-muted f-s-16 l-minus-2"></i>
									</a>
								</div>
								<!-- begin btn-group -->
								<div class="btn-group dropdown m-r-5">
									<button class="btn btn-white btn-sm" data-toggle="dropdown">
										View All <span class="caret m-l-3"></span>
									</button>
									<ul class="dropdown-menu text-left text-sm">
										<li class="active"><a href="javascript:;"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> All</a></li>
										<li><a href="{{url('tickets')}}"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Priority</a></li>
										<li><a href="{{url('tickets/unread')}}"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Unread</a></li>
										<li><a href="{{url('tickets/date')}}"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Date Created</a></li>
										<li><a href="javascript:;"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Newsletters</a></li>
										<li><a href="javascript:;"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Social updates</a></li>
										<li><a href="javascript:;"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> Everything else</a></li>
									</ul>
								</div>
								<!-- end btn-group -->
								<!-- begin btn-group -->
								<div class="btn-group m-r-5">
									<button class="btn btn-sm btn-white"><i class="fa fa-redo f-s-14 t-plus-1"></i></button>
								</div>
								<!-- end btn-group -->
								<!-- begin btn-group -->
								<div class="btn-group">
									<button class="btn btn-sm btn-white hide" data-email-action="delete"><i class="fa t-plus-1 fa-times f-s-14 m-r-3"></i> <span class="hidden-xs">Delete</span></button>
									<button class="btn btn-sm btn-white hide" data-email-action="archive"><i class="fa t-plus-1 fa-folder f-s-14 m-r-3"></i> <span class="hidden-xs">Archive</span></button>
									<button class="btn btn-sm btn-white hide" data-email-action="archive"><i class="fa t-plus-1 fa-trash f-s-14 m-r-3"></i> <span class="hidden-xs">Junk</span></button>
								</div>
								<!-- end btn-group -->
								<!-- begin btn-group -->
								<div class="btn-group ml-auto">
									<input type="text" name="" class="form-control" id="ticketSearch" placeholder="Search">
								</div>
								<!-- end btn-group -->
							</div>
							<!-- end btn-toolbar -->
						</div>
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
									<!-- begin scrollbar -->
									<div data-scrollbar="true" data-height="100%">
										<!-- begin list-email -->
										<ul class="list-group list-group-lg no-radius list-email">

										
									<table id="datatable" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th width="100%">Priority</th>
											</tr>
										</thead>	
										<tbody>
											<tr>
												<td>
													<li class="list-group-item liTicketId @if(1 == 0) unread  @endif " value="123" >
												
												<a href="email_detail.html" class="email-user bg-orange">
													<span class="text-white">PUP</span>
												</a>
												<div class="email-info">
													<a href="1525">

														<span class="email-time">
															123
														</span>
														<span class="topic" hidden>123</span>
														<span class="email-sender">123
															@if(now() >=now())
																<span class="badge bg-red">Overdue</span>
															@endif
														</span>
														
														<span class="email-title">
														@for($i = 0 ; 123>123412 ; $i++)
														<span class="fa fa-star checked"></span>
														@endfor</span>
														<span class="email-desc">123</span>
													</a>
												</div>
											</li>
												</td>
											</tr>
										</tbody>
									</table>
											
										</ul>
										<!-- end list-email -->
									</div>
									<!-- end scrollbar -->
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
						<!-- begin wrapper -->
						<div class="wrapper bg-silver-lighter clearfix">
							{{-- <div class="btn-group pull-right">
								<button class="btn btn-white btn-sm">
									<i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
								</button>
								<button class="btn btn-white btn-sm">
									<i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
								</button>
							</div>
							<div class="m-t-5 text-inverse f-w-600">1,232 messages</div> --}}
						</div>
						<!-- end wrapper -->
					</div>
					<!-- end vertical-box -->
		        </div>
		        <!-- end vertical-box-column -->
		    </div>
		    <!-- end vertical-box -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
       
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
@section('page-js')
	<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
	<script>
		var filter = 'View all';
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
	                { "data": "ticket_no" }
	            ]	 

	        });

			App.init();
			InboxV2.init();
			


		});

		$("#ticketSearch").on('input',function(){
			lengthInSearch = $(this).val().length
			textInSearch = $(this).val()
			
			$( ".liTicketId" ).each(function() {
				var tempTicketNo = $(this).val();
				if(lengthInSearch == 0){
					$(this).show()
					filterTopic(filter)
				}
				else if((tempTicketNo.toString().slice(0,lengthInSearch) == textInSearch) && $(this).is(":visible")){
					$(this).show()
				}
				else{
					$(this).hide()
				}
				
			});
			
		})

		$(".menuTopic").on('click',function(){
			filter = $(this).text()
			filterTopic(filter)
			$('.liMenuTopic').removeClass('active');
        	$(this).closest("li").addClass('active');

		})

		function filterTopic(topic){
			$( "#datatable" ).each(function() {
				console.log($(this).text().trim())
				 if(filter.trim() == "View all"){
					$(this).closest("li").show()
				}
				else if(topic.trim() != $(this).text().trim()){
					$(this).closest("li").hide()
				}
				else{
					$(this).closest("li").show()
				}
				// alert()

			});
		}

	</script>
@endsection
@endsection
