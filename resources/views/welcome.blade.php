<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>PUP | Support</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/forum/style.min.css" rel="stylesheet" />
    <link href="../assets/css/forum/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/forum/theme/default.css" id="theme" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container -->
        <div class="container">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.html" class="navbar-brand">
                    <img style="float: left" src="https://www.pup.edu.ph/about/images/PUPLogo.png" alt="" />
                        &nbsp&nbspHelpDesk
                    </span>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- begin #header-navbar -->
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li><a href="{{ route('register') }}">Create Account</a></li>
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                </ul>
            </div>
            <!-- end #header-navbar -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #header -->
    
    <!-- begin search-banner -->
    <div class="search-banner has-bg">
        <!-- begin bg-cover -->
        <div class="bg-cover">
            <img src="{{asset('assets/img/pup.jpg')}}" alt="" />
        </div>
        <!-- end bg-cover -->
        <!-- begin container -->
        <div class="container">
            <h1>Welcome to the Support Center</h1>
            <p>
               In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket
            </p>
        </div>
        <!-- end container -->
    </div>
    <!-- end search-banner -->
    
    <div class="content">
        <!-- begin container -->
        
        <div class="container">
            

            <div class="col-lg-12">
                    <!-- begin nav-tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-items">
                            <a href="#default-tab-1" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Open New Ticket</span>
                            </a>
                        </li>
                        <li class="nav-items">
                            <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Check Ticket Status</span>
                            </a>
                        </li>
                        
                    </ul>
                    <!-- end nav-tabs -->
                    <!-- begin tab-content -->
                    <div class="tab-content">
                        <!-- begin tab-pane -->
                        <div class="tab-pane fade" id="default-tab-1">
                            <h3 class="m-t-10"><i class="fa fa-cog"></i> Create Ticket</h3>
                            <p>
                                Fill up the form below to open new ticket.
                            </p>
                            <hr>
                            
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="sample@email.com" class="form-control txt_email">
                                </div>
                            </div>
                            
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Full Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="First Name" class="form-control txt_fname">
                                </div>

                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label"></label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="Middle Name" class="form-control txt_mname">
                                </div>
                                
                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label"></label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="Last Name" class="form-control txt_lname">
                                </div>
                                
                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Contact No.</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="1234567890" class="form-control txt_contact_no">
                                </div>
                            </div>
                            <hr>
                            
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Topic</label>
                                <div class="col-md-6 sel_topic">
                                    <select class="form-control selTopic" name="selTopic">
                                        @foreach($data as $val)
                                            <option value="{{$val->topic_id}}">{{$val->topic_summary}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Issue Summary</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="Sample summary" class="form-control txt_summary">
                                </div>
                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Ticket Details</label>
                                <div class="col-md-6">
                                    <form action="/" name="wysihtml5" class="wysihtml5" method="">
                                        
                                        <textarea class="textarea form-control txt_issue"  placeholder="Enter text ..." rows="5"></textarea>
                                      
                                    </form>
                                </div>
                            </div>
                            <p class="text-right m-b-0">
                                <a href="javascript:;" class="btn btn-white m-r-5" id="btn_auto_fill">Auto Fill</a>
                                <a href="javascript:;" class="btn btn-primary" id="btn_createTicket">Submit</a>
                            </p>
                        </div>
                        <!-- end tab-pane -->
                        <!-- begin tab-pane -->
                        <div class="tab-pane " id="default-tab-2">
                            
                            <h3 class="m-t-10"><i class="fa fa-cog"></i> Check Ticket Status</h3>
                            <p>
                                Please provide ticket no to check status
                            </p>
                            <hr>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-6">
                                    <input id="txt_email_user" type="text" name="firstname" placeholder="sample@email.com" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Ticket No.</label>
                                <div class="col-md-6">
                                    <input type="text" name="firstname" placeholder="1234567890" id="txt_ticket" class="form-control">
                                </div>
                            </div>
                            <p class="text-right m-b-0">
                                <a href="javascript:;" class="btn btn-primary" id="btn_check">Primary</a>
                            </p>
                        </div>
                        <!-- end tab-pane -->
                        <!-- begin tab-pane -->
                        
                        <!-- end tab-pane -->
                    </div>
            
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->
    
    <!-- begin #footer -->
    <div id="footer" class="footer">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                    <!-- begin section-container -->
                    <center>
                    <div class="section-container">
                        <h4>About PUP QC</h4>
                        <p>
                            Polytechnic University of the Philippines Quezon City (abbreviated as PUPQC; also known as PUP Commonwealth Campus) is one of the satellite campuses of the Polytechnic University of the Philippines located in Commonwealth, Quezon City, Philippines. It was established in 1997. It confers undergraduate and diploma degrees.
                        </p>
                    </div>
                    </center>
                    <!-- end section-container -->
                <!-- end col-4 -->
                <!-- begin col-4 -->
                
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #footer -->
    <!-- begin #footer-copyright -->
    <div id="footer-copyright" class="footer-copyright">
        <div class="container">
            &copy; 2020 - 2021 SRG All Right Reserved
            
        </div>
    </div>

    <div class="modal fade" id="modal-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ticket Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="modal_dept_id" name="" hidden>
                        <h3 id="department_name"></h3>
                        <table id="tbl_user" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="70%">Date</th>
                                    <th width="30%">Status</th>
                                </tr>
                            </thead>
                            <tbody id="body_modal">





                            </tbody>
                        </table>
                        <div class="div_emp"></div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <a href="javascript:;" class="btn btn-success" id="btn_send_mail">Send Email</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- end #footer-copyright -->
    <!-- begin theme-panel -->
  
    <!-- end theme-panel -->
    
    <!-- ================== BEGIN BASE JS ================== -->
   
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="../assets/plugins/js-cookie/js.cookie.js"></script>
    <script src="../assets/js/forum/apps.min.js"></script>
    <script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/form-wysiwyg.demo.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
    
    <script>    
        $("#txt_ticket").val('1582060016')
        $("#txt_email_user").val('atom.macalla29@gmail.com')

        $("#btn_auto_fill").click(function(){
             $(".txt_email").val('atommic962@gmail.com')
             $(".txt_fname").val('anel thom')
             $(".txt_mname").val('tuliao')
             $(".txt_lname").val('macalla')
             $(".txt_contact_no").val('09981827161')
             $(".txt_summary").val('Lost Registaration Card')
             $(".txt_issue").val('Main Issue')
        })


        $('#btn_createTicket').on('click',function(){
            email = $(".txt_email").val()
            // alert(email)
            fname = $(".txt_fname").val()
            mname = $(".txt_mname").val()
            lname = $(".txt_lname").val()
            contact_no = $(".txt_contact_no").val()
            topic = $( ".sel_topic option:selected" ).val()
            summary = $(".txt_summary").val()
            issue = $(".txt_issue").val()
            $.ajax({
                url:'{{route('createTicket')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'email':email
                  ,'fname':fname
                  ,'mname':mname
                  ,'lname':lname
                  ,'contact_no':contact_no
                  ,'topic':topic
                  ,'summary':summary
                  ,'issue':issue
                  
                },
                success:function(data)
                {
                    swal("Success! Your ticket no: "+data.data+"", {
                          icon: "success",
                        }).then((willreload) => {
                            if(willreload){
                                window.location.reload()
                            }
                        });
                  console.log(data)
                   
                }
            })  
        });


        $("#btn_send_mail").click(function(){
            ticket = $("#txt_ticket").val()
            email = $("#txt_email_user").val()
            // alert(ticket)
            
            $.ajax({
                url:'{{route('checkTicket')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  ,'ticket':ticket
                  ,'email':email
                  
                },
                success:function(data)
                {
                    console.log(data)
                    if(data.data == 1)
                    {
                        $.ajax({
                        url:'{{route('sendFullConvo')}}',
                        type:'POST',
                        
                        data: {
                          "_token": "{{ csrf_token() }}"
                          , "ticket": $("#txt_ticket").val()
                          , "email": $("#txt_email_user").val()
                        },
                        success:function(data)
                        {
                            console.log(data)
                            // $("#txt_email_summary").val(data['response'][0]['ticket_summary'])
                           
                        }
                    })  
                    }
                   
                }
            })  
            
        })

        $("#btn_check").click(function(){
            $("#modal-message").modal('show')
            $ticket = $("#txt_ticket").val()
            // alert($ticket)
            $.ajax({
                url:'{{route('ticketStatus')}}',
                type:'POST',
                
                data: {
                  "_token": "{{ csrf_token() }}"
                  , "ticket": $ticket
                  
                },
                success:function(data)
                {
                    console.log(data.ticket_history)
                            $("#body_modal").empty()
                            for(i = 0 ; i<data.ticket_history.length; i++){
                                $("#body_modal").append('<tr ><td style="padding: 10px; "><p hidden></p><a style=" font-size: 15px; text-transform: uppercase; ">&nbsp&nbsp '+data.ticket_history[i]['created_at']+' </a></td><td><p  style="text-transform: capitalize">'+data.ticket_history[i]['history_status']+'</p></td></tr>')
                            }  
                }
            })  
        })

        $(document).ready(function() {
            App.init();
            $('.txt_issue').wysihtml5({
          toolbar: {
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": false, //Button to insert an image. Default true,
            "color": false, //Button to change color of font  
            "blockquote": true, //Blockquote  
            
          }
        });
        });
    </script>
</body>
</html>
