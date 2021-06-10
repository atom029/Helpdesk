@extends('global.main')
@section('title', "PUP | Support")

@section('page-css')
    
   
@endsection

@section('content')
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
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
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand"><b>Login</b> 
                        <small>Welcome to PUP Support</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form action="index.html" method="GET" class="margin-bottom-0">
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control form-control-lg" id="username" placeholder="Email Address" required />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" required />
                        </div>
                      
                        <div class="login-buttons">
                            <button type="button" class="btn btn-success btn-block btn-lg" id="btn_login">Sign me in</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            Not a member yet? Click <a href="{{ route('register') }}" class="text-success">here</a> to register.
                        </div>
                        <hr />
                        <p class="text-center text-grey-darker">
                           &copy; 2020 - 2021 SRG All Right Reserved
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
        
        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-theme-file="../assets/css/default/theme/default.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="../assets/css/default/theme/red.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="../assets/css/default/theme/blue.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="../assets/css/default/theme/purple.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="../assets/css/default/theme/orange.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="../assets/css/default/theme/black.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control form-control-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage">Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->
    </div>
    <!-- end page container -->
    
 
    @section('page-js')
    <script>
        $("#btn_login").on('click',function(){
            username =  $("#username").val()
            password = $("#password").val()
            $.ajax({
                url:'{{route('checkCred')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'username':username
                  ,'password':password
                  
                },
                success:function(data)
                {
                    console.log(data)
                    if(data == 0){
                        swal("Email or password is incorrect", {
                                      icon: "error",
                                    }).then((willreload) => {
                                        if(willreload){
                                            // window.location.reload()
                                        }
                                    });
                    }
                  else if(data.data.length > 0 ){
                     if(data.data[0]['user_is_admin'] == 1 ){
                        location.href = "{{route('adminDashboard')}}"
                    }
                    
                    else if( data.data[0]['user_is_agent'] == 1){
                        location.href = "{{route('dashboard')}}"
                    }

                    else if( data.data[0]['user_id'] > 1){
                         location.href = "{{route('userTickets')}}"
                    }
                    else{
                          swal("Email or password is incorrect", {
                                      icon: "error",
                                    }).then((willreload) => {
                                        if(willreload){
                                            // window.location.reload()
                                        }
                                    });
                    }
                  }
                
                   
                }
            })  
        })

        $(document).ready(function() {
            App.init();
        });
    </script>
    @endsection
@endsection
