@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')

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
												<li class="active btn_ifAssigned" id="btn_assigned"><a ><i class="fa fa-inbox fa-fw m-r-5"></i> Assigned <span class="badge pull-right">{{count($assigned)}}</span></a></li>
												<li id="btn_unAssigned" class="btn_ifAssigned"><a ><i class="fa fa-flag fa-fw m-r-5"></i> Unassigned <span class="badge pull-right">{{count($unAssigned)}}</span></a></li>
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
						
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
									<!-- begin scrollbar -->
									<div data-scrollbar="true" data-height="100%" id="users">

									<!-- class="search" automagically makes an input a search field. -->
									  <div class="btn-group ml-auto" style="padding: 20px">
												<input type="text" name="" sty class="form-control search"  placeholder="Search">
											</div>
									<!-- class="sort" automagically makes an element a sort buttons. The date-sort value decides what to sort by. -->
									  <button class="sort btn btn-default" data-sort="email-sender">
									    Ticket No
									  </button>
									  <button class="sort btn btn-default" data-sort="priority">
									    Priority
									  </button>
									 
									  <button class="sort btn btn-default" data-sort="hours">
									    Response Time
									  </button>
									  



									<!-- Child elements of container with class="list" becomes list items -->
									  <ul class="list-group list-group-lg no-radius list-email list">
									   @foreach($assigned as $val)
											<li class="list-group-item liTicketId liAssigned @if($val->is_read_admin == 0) unread  @endif " value="{{$val->ticket_no}}-1" >
												
												<a href="email_detail.html" class="email-user bg-orange">
													<span class="text-white">PUP</span>
												</a>
												<div class="email-info">
													<a href="{{url('timeline') }}/ {{$val->ticket_id}}">
														<span class="inboxs" hidden>Assigned</span>
														<span class="email-time date timestamp" data-timestamp="{{date('d-m-Y', strtotime($val->ticket_created_at))}}">
															{{date('d-m-Y', strtotime($val->ticket_created_at))}}
														</span>
														<span class="topic" hidden>{{$val->topic_summary}}-1</span>
														<span class="email-sender">{{$val->ticket_no}}
															
														</span>
														
														<span class="priority" hidden>{{$val->ticket_priority}}</span>
														<span class="email-title">
															@for($i = 0 ; $i< $val->ticket_priority ; $i++)
															<span class="fa fa-star checked"></span>
															@endfor
														</span>

														<span class="email-desc">{{$val->ticket_summary}}</span>
														<br>
														<span class="badge bg-gray summary">{{$val->topic_summary}}</span> 
														@if(now() >= $val->ticket_date)
															<span class="badge bg-red overdue">Overdue</span>

														@else
															<span class="badge bg-red hours">{{now()->diffInHours($val->ticket_date)}} HOURS</span>
														@endif
														@if($val->is_answered == 1) <span class="badge bg-green answered">Answered</span>  @endif
														@if($val->is_read_admin == 0) <span class="badge bg-blue unread">Unread</span> 


														@endif

													</a>
												</div>
											</li>
										
										@endforeach
										 @foreach($unAssigned as $val)
											<li class="list-group-item liTicketId liUnassigned @if($val->is_read_admin == 0) unread  @endif " value="{{$val->ticket_no}}-0" >
												
												<a href="email_detail.html" class="email-user bg-orange">
													<span class="text-white">PUP</span>
												</a>
												<div class="email-info">
													<a href="{{url('timeline') }}/ {{$val->ticket_id}}">
														<span class="inboxs" hidden>unAssigned</span>
														<span class="email-time date timestamp" data-timestamp="{{date('d-m-Y', strtotime($val->ticket_created_at))}}">
															{{date('d-m-Y', strtotime($val->ticket_created_at))}}
														</span>
														<span class="topic" hidden>{{$val->topic_summary}}-0</span>
														<span class="email-sender">{{$val->ticket_no}}
															
														</span>
														
														<span class="priority" hidden>{{$val->ticket_priority}}</span>
														<span class="email-title">
															@for($i = 0 ; $i< $val->ticket_priority ; $i++)
															<span class="fa fa-star checked"></span>
															@endfor
														</span>

														<span class="email-desc">{{$val->ticket_summary}}</span>
														<br>
														<span class="badge bg-gray summary">{{$val->topic_summary}}</span> 
														@if(now() >= $val->ticket_date)
															<span class="badge bg-red overdue">Overdue</span>

														@else
															<span class="badge bg-red hours">{{now()->diffInHours($val->ticket_date)}} HOURS</span>
														@endif
														@if($val->is_answered == 1) <span class="badge bg-green answered">Answered</span>  @endif
														@if($val->is_read_admin == 0) <span class="badge bg-blue unread">Unread</span> 


														@endif

													</a>
												</div>
											</li>
										
										@endforeach
									  </ul>

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
	<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
	<script src="{{asset('assets/js/list.js')}}"></script>
	<script>

		$(".liUnassigned").hide()

		var options = {
		  valueNames: [ "summary"
		,"overdue"
		,"answered"
		,"email-sender"
		,"priority"
		,"hours" 
		]
		};

		var userList = new List('users', options);



		var filter = 'View all';
		var isAssined = '1';
		$(document).ready(function() {
			
			
			
			App.init();
			InboxV2.init();
			
		});

		$("#btn_unAssigned").on('click',function(){
			isAssined = 0
			$('.btn_ifAssigned').removeClass('active');
        	$(this).closest("li").addClass('active');
			 $( ".inboxs" ).each(function() {
				 if($(this).text() == "Assigned"){
					$(this).closest("li").hide()
				}
				else{
					$(this).closest("li").show()
				}
				// alert()

			});
		})

		$("#btn_assigned").on('click',function(){
			isAssined = 1
			$('.btn_ifAssigned').removeClass('active');
        	$(this).closest("li").addClass('active');
			 $( ".inboxs" ).each(function() {
				 if($(this).text() == "unAssigned"){
					$(this).closest("li").hide()
				}
				else{
					$(this).closest("li").show()
				}
				// alert()

			});
		})

		$("#ticketSearch").on('input',function(){
			lengthInSearch = $(this).val().length
			textInSearch = $(this).val()
			
			$( ".liTicketId" ).each(function() {
				var tempTicketNo = $(this).val().split('-');
				alert( tempTicketNo[1] )
				if(lengthInSearch == 0 && tempTicketNo[1] == isAssined){
					$(this).show()
					filterTopic(filter)
				}
				else if((tempTicketNo[0].toString().slice(0,lengthInSearch) == textInSearch) && $(this).is(":visible")){
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
			$( ".topic" ).each(function() {
				topicText = $(this).text().split('-')
				 if(filter.trim() == "View all" && topicText[1] == isAssined){
					$(this).closest("li").show()
				}
				else if(topic.trim() != topicText[0]){
					$(this).closest("li").hide()
				}
				else if(topic.trim() == topicText[0] && ($(this).is(":visible") || topicText[1] == isAssined)){

					$(this).closest("li").show()
				}
				// alert()

			});
			// alert(isAssined)
		}

	</script>
@endsection
@endsection
