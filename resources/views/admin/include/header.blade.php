<!-- begin #page-container -->
	  @if(session('user') == '')
		<script type="text/javascript">
			location.href='{{route("landing")}}'

		</script>
	@endif
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>PUP</b> Support</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown" >
					<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
						<i class="fa fa-bell"></i>
						<span class="label" id="notif_count">0</span>
					</a>
					<ul class="dropdown-menu media-list dropdown-menu-right" id="notif" >
						<li class="dropdown-header">NOTIFICATIONS</p></li>
						
						</li>
						
						
					</ul>
				</li>
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="../assets/img/user/user-13.jpg" alt="" /> 
						<span class="d-none d-md-inline">{{session('user_name')}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						
						<a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="../assets/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
								{{session('user_name')}}
								@if(session('is_admin') == 1)


								<small>Admin</small>
								@elseif(session('is_agent') == 1)
								<small>Agent</small>
								@else
								<small>User</small>
								@endif
							</div>
						</a>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					@if(session('is_admin') == 1)
					<li class="has-sub ">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fa fa-th-large"></i>
						    <span>System Setup</span>
					    </a>
						<ul class="sub-menu">
							<li class="active"><a href="{{ route('user') }}">User</a></li>
						    <li class=""><a href="{{ route('department') }}">Department</a></li>
						    <li><a href="{{ route('topic') }}">Topic</a></li>
						</ul>
						<li class="has-sub ">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fa fa-th-large"></i>
						    <span>Report</span>
					    </a>
						<ul class="sub-menu">
							<li class="active"><a href="{{ route('allAgentPerformance') }}">Agents Performance</a></li>
						</ul>
					</li>
					</li>
					

					@endif
					@if(session('is_agent') == 1)
					<li class=" ">
						<a href="{{ route('dashboard') }}">
						    <i class="fa fa-th-large"></i>
						    <span>Dashboard</span>
					    </a>
					</li>
					<li class=" ">
						<a href="{{ route('tickets') }}">
						    <i class="fa fa-th-large"></i>
						    <span>Tickets</span>
					    </a>
					</li>
					@elseif(session('is_admin') != 1)
					<li class="has-sub ">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fa fa-th-large"></i>
						    <span>Report</span>
					    </a>
						<ul class="sub-menu">
							<li class="active"><a href="{{ route('reports') }}">Performance</a></li>
						</ul>
					</li>
					@endif
					
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<!-- end #sidebar -->
		<div class="sidebar-bg"></div>
	</div>
