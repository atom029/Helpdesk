@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- ================== END PAGE LEVEL STYLE ================== -->
<style type="text/css">
	

<style type="text/css">
    .dropzone {
        border:2px dashed #999999;
        border-radius: 10px;
    }
    .dropzone .dz-default.dz-message {
        height: 171px;
        background-size: 132px 132px;
        margin-top: -101.5px;
        background-position-x:center;

    }
    .dropzone .dz-default.dz-message span {
        display: block;
        margin-top: 145px;
        font-size: 20px;
        text-align: center;
    }
</style>
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
	<h1 class="page-header">Manage User <small></small></h1>
	<!-- end page-header -->

	<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <div class="row">
            <div class="col-md-12">
              <strong>Laravelcode - Multiple files uploading using dropzoneJs</strong>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('multifileupload') }}" enctype="multipart/form-data" class="dropzone" id="fileupload" method="POST">
            @csrf
            <div class="fallback">
              <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

			<!-- begin panel-body -->
			<div class="card">
							<div class="card-header bg-black  text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">
								Add User
							</div>
							<div id="collapseOne" class="collapse " data-parent="#accordion">
								<div class="card-body">
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label">Personal Information</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<div class="col-md-4">
													
													<label>First Name</label>
													<input type="text" class="form-control" id="fname" />
													
												</div>
												<div class="col-md-4">
													<label>Middle Name</label>
													<input type="text" class="form-control" id="mname" />
												</div>
												<div class="col-md-4">
													<label>Last Name</label>
													<input type="text" class="form-control" id="lname" />
												</div>
											</div>
										</div>
									</div>
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label"></label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<div class="col-md-4">
													<label>Email</label>
													<input type="text" class="form-control" id="email" />
												</div>
												<div class="col-md-4">
													<label>Contact No</label>
													<input type="text" class="form-control" id="contact_no" />
												</div>
											</div>
										</div>
									</div>
									<div class="row form-group m-b-30">
										<label class="col-md-3 col-form-label"></label>
										<div class="col-md-9">
											<input type="checkbox" id="chk_admin" />
				                            <label for="chk_admin">
				                                Adminstrator
				                            </label>
										</div>
									</div>
									<div class="row form-group m-b-30" id="cred">
										<label class="col-md-3 col-form-label">Credentials</label>
										<div class="col-md-9">
											<div class="row row-space-12">
												<div class="col-md-4">
													
													<label>Username</label>
													<input type="text" class="form-control " id="username" />
													
												</div>
												<div class="col-md-4">
													<label>Password</label>
													<input type="text" class="form-control " id="password" />
												</div>
												<div class="col-md-4">
													<label>Confirm Password</label>
													<input type="text" class="form-control " id="password2" />
												</div>
											</div>
										</div>

									</div>
									<button class=" btn btn-success pull-right" style="align-self: right;" id="btn_add_user">Submit</button>
									<div class="row text-right col-lg-12" >
										
										
									</div>

								</div>
								
								
							</div>
						</div>
			<!-- end panel-body -->
		

	



	<!-- begin panel -->
	<div class="panel panel-inverse">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="panel-heading-btn">
				
			</div>
			<h4 class="panel-title">Data Table - Default</h4>
		</div>
		<!-- end panel-heading -->
		<!-- begin panel-body -->
		<div class="panel-body">
			<table id="tbl_user" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="70%">User Information</th>
						<th width="30%">Action</th>
					</tr>
				</thead>
				<tbody>
					{{-- @foreach($data as $val)
						<tr >
							<td style="padding: 10px; ">
								<p hidden>{{$val->user_id}}</p>
								<b style="margin-left: 20px; font-size: 15px">Name:</b>
								<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->user_lname}}, {{$val->user_fname}} {{$val->user_mname}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Email:</b> 
								<a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp {{$val->user_email}}</a>
								<br>
								<b style="margin-left: 20px; font-size: 15px">Contact No:</b> 
								<a style=" font-size: 15px;text-transform: uppercase;">&nbsp&nbsp {{$val->user_contact_no}}</a>
							</td>
							<td>
								<button class="btn btn-success btn_approve" id="">Approve</button>
								<button class="btn btn-danger">Deny</button>
							</td>
						</tr>
					@endforeach --}}
					
					

					
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
	
	$("#tbl_user").on('click','.btn_approve',function(){
		 alert($(this).closest("tbody tr").find("p").text())
	})


	$("#btn_add_user").on('click',function(){
		
		

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
                  ,'is_admin':is_admin
                  ,'username':username
                  ,'password':password
                  ,'is_active':'1'
                  ,'is_approve':'1'
                  
                  
                },
                success:function(data)
                {
                  console.log(data)
                   
                }
            })  
	});

	

	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
  Dropzone.options.fileupload = {
    accept: function (file, done) {
      if (file.type != "application/vnd.ms-excel" && file.type != "image/jpeg, image/png, image/jpg") {
        done("Error! Files of this type are not accepted");
      } else {
        done();
      }
    }
  }

Dropzone.options.fileupload = {
  	maxFiles: 5,
	maxFilesize: 20,
	acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
}

if (typeof Dropzone != 'undefined') {
  Dropzone.autoDiscover = false;
}

;
(function ($, window, undefined) {
  "use strict";

  $(document).ready(function () {
    // Dropzone Example
    if (typeof Dropzone != 'undefined') {
      if ($("#fileupload").length) {
        var dz = new Dropzone("#fileupload"),
          dze_info = $("#dze_info"),
          status = {
            uploaded: 0,
            errors: 0
          };
        var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');
        dz.on("success", function (file, responseText) {

            var _$f = $f.clone();

            _$f.addClass('success');

            _$f.find('.name').html(file.name);
            if (file.size < 1024) {
              _$f.find('.size').html(parseInt(file.size) + ' KB');
            } else {
              _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
            }
            _$f.find('.type').html(file.type);
            _$f.find('.status').html('Uploaded <i class="entypo-check"></i>');

            dze_info.find('tbody').append(_$f);

            status.uploaded++;

            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');
            alert('Your File Uploaded Successfully!!')

          })
          .on('error', function (file) {
            var _$f = $f.clone();

            dze_info.removeClass('hidden');

            _$f.addClass('danger');

            _$f.find('.name').html(file.name);
            _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
            _$f.find('.type').html(file.type);
            _$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');

            dze_info.find('tbody').append(_$f);

            status.errors++;

            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

            alert('Your File not Uploaded Successfully!!')
          });
      }
    }
  });
})(jQuery, window); 
</script>
@endsection
@endsection