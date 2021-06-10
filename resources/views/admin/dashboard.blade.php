@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />

<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- ================== END PAGE LEVEL STYLE ================== -->
<style type="text/css">
.mbox {   
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 10px 55px 10px 25px;
    padding-left: 4px;
}

.donut-legend > span {
  display: inline-block;
  margin-right: 25px;
  margin-bottom: 10px;
  font-size: 13px;
}
.donut-legend > span:last-child {
  margin-right: 0;
}
.donut-legend > span > i {
  display: inline-block;
  width: 15px;
  height: 15px;
  margin-right: 7px;
  margin-top: -3px;
  vertical-align: middle;
  border-radius: 1px;
}

</style>
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
	<h1 class="page-header">Dashboard <small></small></h1>
	<!-- end page-header -->
	<div class="row">
		<!-- begin col-3 -->
		<div class="col-lg-2 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fa fa-desktop"></i></div>
				<div class="stats-info">
					
					<h4>Open Ticket</h4>

					<p>{{$open}}</p>	
					
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-lg-2 col-md-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon"><i class="fa fa-link"></i></div>
				<div class="stats-info">
					<h4>Overdue Ticket</h4>
					<p>{{$overdue}}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-lg-2 col-md-6">
			<div class="widget widget-stats bg-grey-darker">
				<div class="stats-icon"><i class="fa fa-users"></i></div>
				<div class="stats-info">
					<h4>Answered Ticket</h4>
					<p>{{$answered}}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-lg-2 col-md-6">
			<div class="widget widget-stats bg-black-lighter">
				<div class="stats-icon"><i class="fa fa-desktop"></i></div>
				<div class="stats-info">
					<h4>Closed Ticket</h4>
					<p>{{$closed}}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="widget widget-stats bg-black-lighter">
				<div class="stats-icon"><i class="fa fa-desktop"></i></div>
				<div class="stats-info">
					<h4>SLA</h4>
					<p>{{$sla}}%</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-lg-12" style="padding: 20px; background-color: white">
			<h3 style="text-align: center;">Tickets answered / ticket assigned</h3>
			<div id="legend"  ></div>
			<div id="myfirstchart" style="height: 250px;" ></div>
		</div>
		<div class="col-lg-8"style="padding: 20px; background-color: white">
			<h3 style="text-align: center;">Ticket Status</h3>
			<div id="browsers_chart" style="height: 250px;"></div>
			
		</div>
		<div class="col-lg-4"style="padding: 20px; background-color: white;">
			<h3 style="text-align: center;">Open tickets base on priority</h3>
			<div id="donut" style="height: 250px;"></div>
			<div id="legend2" class="donut-legend" style="text-align: center;"></div>
		</div>
	</div>

	<div class="row">
		
	</div>
</div>







@section('page-js')
<!-- ================== BEGIN PAGE LEVEL JS ================== --> 
<script src="{{asset('assets/js/qrcode.min.js')}}"></script>
<script src="{{asset('assets/js/package/dist/Chart.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	var color_array = ['#03658C', '#7CA69E', '#F2594A', '#F28C4B', '#7E6F6A', '#36AFB2', '#9c6db2', '#d24a67', '#89a958', '#00739a', '#BDBDBD'];
	console.log({!! json_encode($chart) !!})
  var chart = 	new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    {!! $chart !!}
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'date',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['asscount','anscount'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Assigned','Answered'],
  hideHover: 'auto',
  resize: true,      
    smooth:true ,
  color: color_array
});

	chart.options.labels.forEach(function(label, i){
    var legendlabel=$('<span style="display: inline-block;">'+label+'</span>')
    var legendItem = $('<div class="mbox"></div>').css('background-color', chart.options.color[i]).append(legendlabel)
    $('#legend').append(legendItem)   
	})


	var browsersChart = Morris.Bar({
    element: 'browsers_chart',
    data   : [
    {"label":"Open","value":{!! $open!!}},
    {"label":"Overdue","value":{!! $overdue!!}},
    {"label":"Answered","value":{!! $answered!!}},
    {"label":"Closed","value":{!! $closed!!}}],
    xkey: 'label',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'],
  hideHover: 'auto',
  resize: true,      
    smooth:true ,
  color: color_array
  });
 


 var donut = Morris.Donut({
    element: 'donut',
    data   : [
    	{!! $donut !!}
    ],
    colors: color_array,
    hideHover: 'auto',
  resize: true,      
    smooth:true ,
  });
  donut.options.data.forEach(function(label, i){
    var legendItem = $('<span></span>').text(label['label']).prepend('<i>&nbsp;</i>');
    legendItem.find('i').css('backgroundColor', donut.options.colors[i]);
    $('#legend2').append(legendItem)
  })
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
	});
</script>
@endsection
@endsection