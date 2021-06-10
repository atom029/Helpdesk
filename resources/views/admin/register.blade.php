<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Register Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/default/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet"  id="theme"  />

    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url({{asset('assets/img/pup.jpg')}})"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>Help</b>Desk</h4>
                    <p>
                       
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    Sign Up
                    <small>Create your HelpDesk Account</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    <form action="index.html" method="GET" class="margin-bottom-0">
                        <label class="control-label">Name <span class="text-danger">*</span></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="text" id="fname" class="form-control" placeholder="First name" required />
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text"  id="mname"class="form-control" placeholder="Middle name" required />
                            </div>
                        </div>
                        <label class="control-label">Last Name<span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text"  id="lname"class="form-control" placeholder="Last name" required />
                            </div>
                        </div>
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" id="email" class="form-control" placeholder="Email address" required />
                            </div>
                        </div>
                        <label class="control-label">Contact No. <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text"  id="contact_no" class="form-control" placeholder="Contact No" required />
                            </div>
                        </div>
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" id="password" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                         <label class="control-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" id="password2" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="register-buttons">
                            <button type="button" class="btn btn-primary btn-block btn-lg" id="btn_add_user">Sign Up</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            Already a member? Click <a href="{{ route('login') }}">here</a> to login.
                        </div>
                        <hr />
                        <p class="text-center">
                            &copy; SRG All Right Reserved 2020
                        </p>
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
        
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
    <!--[if lt IE 9]>
        <script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>
        <script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>
        <script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/theme/default.min.js')}}"></script>
    <script src="{{asset('assets/js/apps.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
    
    
    <script type="text/javascript">
        $("#btn_add_user").on('click',function(){
       

        fname =         $("#fname").val()
        mname =         $("#mname").val()
        lname =         $("#lname").val()
        email =         $("#email").val()
        contact_no =    $("#contact_no").val()
        chk_admin =     $("#chk_admin").val()
        
        username =      $("#username").val()
        password =      $("#password").val()
         password2 =      $("#password2").val()
        if(password != password2)
        {
            swal("Password does not matched", {
                                      icon: "error",
                                    }).then((willreload) => {
                                        if(willreload){
                                            // window.location.reload()
                                        }
                                    });
        }
        else if(password.length < 8)
        {
              swal("Password must atleast have 8 characters", {
                                      icon: "error",
                                    }).then((willreload) => {
                                        if(willreload){
                                            // window.location.reload()
                                        }
                                    });
        } 
        else
        {

        var url = '{{ route("checkUser", ":user") }}';
        url = url.replace(':user', email);
        $.ajax({
                url:url,
                type:'get',
                
                
                success:function(data)
                {
                    alert(data.count)
                    if(data.count ==  2)
                    {
                        swal("Email is already registered", {
                                      icon: "error",
                                    }).then((willreload) => {
                                        if(willreload){
                                            // window.location.reload()
                                        }
                                    });
                    }
                    else
                    {
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
                              ,'is_admin':'0'
                              ,'is_agent':'0'
                              ,'username':email
                              ,'password':password
                              ,'is_active':'1'
                              ,'is_approve':'0'
                              
                              
                            },
                            success:function(data)
                            {
                                swal("Success! User inserted successfully", {
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
                   
                }
            })  

        }
    });
    </script>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
