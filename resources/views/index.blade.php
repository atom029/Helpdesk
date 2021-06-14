<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Pavo is a mobile app Bootstrap HTML template created to help you present benefits, features and information about mobile apps in order to convince visitors to download them">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>Pup Helpdesk</title>
    
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="{{asset('landing/css/bootstrap.css')}}"  rel="stylesheet" >
    <link href="{{asset('landing/css/fontawesome-all.css')}}"  rel="stylesheet" >
    <link href="{{asset('landing/css/swiper.css')}}"  rel="stylesheet" >
    <link href="{{asset('landing/css/magnific-popup.css')}}"  rel="stylesheet" >
    <link href="{{asset('landing/css/styles.css')}}"  rel="stylesheet" >
    <link href="{{asset('images/favicon.png')}}">

    
 
	
</head>
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Pavo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.html"><img src="{{asset('landing/images/helpdesk.png')}}"  alt="alternative"></a> 

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#createTicketTab">Create Ticket <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('register') }}">Signup</a>
                    </li>
                   

                </ul>
              
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

  
    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h1 class="h1-large">Pup Support</h1>
                        <p class="p-large">Start getting things done together with your team based on Pavo's revolutionary team management features</p>
                        <a class="btn-solid-lg" href="#createTicketTab"><i class="fas fa-plus-circle"></i></i>&nbsp&nbspCreate Ticket</a>
                        <a class="btn-solid-lg secondary" href="#checkTicketTab"><i class="fas fa-check"></i>&nbsp&nbspCheck Ticket</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="{{asset('landing/images/pupPylon.png')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Introduction -->
    <div class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p> In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of introduction -->

     <!-- Details 1 -->
    <div id="details" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-container" id="createTicketTab">
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
                         
                            
                            <div class="form-group row m-b-10">
                                <label class="col-md-3 text-md-right col-form-label">Topic</label>
                                <div class="col-md-6 sel_topic">
                                    <select class="form-control">
                                        @foreach($data as $val)
                                            <option value="{{$val->topic_id}}">{{$val->topic_summary}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                           
                            
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
                                        
                                        <textarea class="textarea form-control txt_issue"  placeholder="Enter text ..." rows="5" onblur="check()"></textarea>
                                      
                                    </form>
                                </div>
                            </div>
                            <p class="text-right m-b-0">
                                <a href="javascript:;" class="btn btn-white m-r-5" id="btn_auto_fill">Auto Fill</a>
                                <a href="javascript:;" class="btn btn-primary" id="btn_createTicket">Submit</a>
                            </p>
                </div> <!-- end of col -->
                <div class="col-lg-5">
                    <div class="image-container mobileImageHide">
                        <br><br><br><br><br><br><br>
                        <img class="img-fluid" src="{{asset('landing/images/createTicket.svg')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->


     <!-- Details 2 -->
    <div id="checkTicketTab">
    <div class="basic-3" >
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="image-container mobileImageHide">
                        <img class="img-fluid" src="{{asset('landing/images/checkTicket.svg')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <br>
                <br>
                <div class="col-lg-7" >
                    <div class="text-container">
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
                        <a href="javascript:;" class="btn btn-primary" id="btn_check">Check Status</a>
                    </p>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    </div>
    <!-- end of details 2 -->

    <!-- Statistics -->
    <div class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Counter -->
                    <div id="counter">
                        <div class="cell">
                            <div class="counter-value number-count" data-count="231">1</div>
                            <p class="counter-info">Happy Users</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="385">1</div>
                            <p class="counter-info">Issues Solved</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="159">1</div>
                            <p class="counter-info">Good Reviews</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="127">1</div>
                            <p class="counter-info">Case Studies</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="211">1</div>
                            <p class="counter-info">Orders Received</p>
                        </div>
                    </div>
                    <!-- end of counter -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of counter -->
    <!-- end of statistics -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled li-space-lg p-small">
                        <li><a href="article.html">Article Details</a></li>
                        <li><a href="terms.html">Terms & Conditions</a></li>
                        <li><a href="privacy.html">Privacy Policy</a></li>
                    </ul>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <p class="p-small statement">Copyright © <a href="#your-link">Pup Quezon City Branch</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright --> 
    <!-- end of copyright -->
    

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
    	
    <!-- Scripts -->
    <script src="{{asset('landing/js/jquery.min.js')}}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{asset('landing/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('landing/js/swiper.min.js')}}"></script>
    <script src="{{asset('landing/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('landing/js/scripts.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        

        window.onresize = function() {
            console.log($(document).width())
            if($(document).width() < 975){
                $(".mobileImageHide").hide();
            }
            else{
                $(".mobileImageHide").show();
            }
        }

        $("#btn_auto_fill").click(function(){
             $(".txt_email").val('atommic962@gmail.com')
             $(".txt_fname").val('anel thom')
             $(".txt_mname").val('tuliao')
             $(".txt_lname").val('macalla')
             $(".txt_contact_no").val('09981827161')
             $(".txt_summary").val('Lost Registaration Card')
             $(".txt_issue").val('Main Issue')
        })

        var profanity = ''
        $('#btn_createTicket').on('click',function(){
            
            
            
            checkProfanity()
            
        });

        function checkProfanity(){
           var profanity = 0
           $issue = $(".txt_issue").val()
           $summary = $(".txt_summary").val()
           $.ajax({
              url:'{{route('getProfanityWords')}}',
              type:'get',
              
              async: !1,
              success:function(data)
              {
                    // profanityWords = data
                    // console.log(data)
                    count = 0;
                    $.each(data, function(i, item) {
                        if($issue.includes(item[count]['profanity_word']) || $summary.includes(item[count]['profanity_word'])){
                            profanity = 1
                        }

                        count++
                    });
                    email = $(".txt_email").val()
                    // alert(email)
                    fname = $(".txt_fname").val()
                    mname = $(".txt_mname").val()
                    lname = $(".txt_lname").val()
                    contact_no = $(".txt_contact_no").val()
                    topic = $( ".sel_topic option:selected" ).val()
                    summary = $(".txt_summary").val()
                    issue = $(".txt_issue").val()
                    if(profanity == 1){
                        swal({
                            title: "Are you sure?",
                            text: "We found some profanity word in this ticket!", 
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
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
                                      ,'profanity': profanity
                                      
                                    },
                                    success:function(data)
                                    {

                                        
                                        ticket_no = data.data
                                        alert(ticket_no)
                                        $.ajax({
                                            url:'{{route('sendTicketNo')}}',
                                            type:'POST',
                                            
                                            data: {
                                              "_token": "{{ csrf_token() }}"
                                              ,"response": ticket_no
                                              ,"email": email
                                            },
                                            success:function(data)
                                            {
                                                 swal("Success! We send the ticket no. to your email", {
                                              
                                              icon: "success",
                                            }).then((willreload) => {
                                                if(willreload){
                                                    window.location.reload()
                                                }
                                            });
                                               
                                            }
                                        }) 

                                       
                                    }
                                }) 
                            } 
                        });
                    }
                    else{
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
                              ,'profanity': profanity
                              
                            },
                            success:function(data)
                            {

                                    ticket_no = data.data
                                    alert(ticket_no)
                                        $.ajax({
                                            url:'{{route('sendTicketNo')}}',
                                            type:'POST',
                                            
                                            data: {
                                              "_token": "{{ csrf_token() }}"
                                              ,"ticket_no": ticket_no
                                              ,"email": email
                                            },
                                            success:function(data)
                                            {
                                                 swal("Success! We send the ticket no. to your email", {
                                              
                                              icon: "success",
                                            }).then((willreload) => {
                                                if(willreload){
                                                    window.location.reload()
                                                }
                                            });
                                               
                                            }
                                        }) 
                               
                            }
                        })  
                    }
                         
              }
          })
          
        }



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
            if($(document).width() < 975){
                $(".mobileImageHide").hide();
            }
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