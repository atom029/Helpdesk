<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title>PUP | SUPPORT</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  
  @include('include.base_css')

  @yield('page-css')
</head>
<body class="pace-top bg-white">
  @yield('content')

  
  @include('include.base_js')
  @yield('page-js')
  @yield('page-script')
  <script type="text/javascript">
    past_length = 0;
    setInterval(function(){
      $.ajax({
            url:'{{route('getNotif')}}',
            type:'get',
            
            
            success:function(data)
            {
              // console.log(data)
              if(data.notif.length == past_length){

              }
              else{
                past_length = data.notif.length;
                $("#notif").empty()
              for(i = 0 ; i< data.notif.length; i++){
                if(i == 5){
                  break;
                }
                else{
                // alert('push')
                 
                $("#notif").append('<li class="media"><a href="{{url('timeline') }}/'+data.notif[i]['ticket_id']+'"><div class="media-left"><i class="fa fa-bell media-object bg-silver-darker"></i></div><div class="media-body"><h6 class="media-heading">'+data.notif[i]['ticket_summary']+' <i class="fa fa-exclamation-circle text-danger"></i></h6><div class="text-muted f-s-11" >'+data.notif[i]['notification_summary']+'</div></div></a></li>')
                }
              }
              $("#notif_count").text(i)
              // alert()
          }
          }
        })  
    },3000);

    

    function checkProfanity($string){
           $.ajax({
              url:'{{route('getProfanityWords')}}',
              type:'get',
              
              
              success:function(data)
              {
                    // profanityWords = data
                    // console.log(data)
                    count = 0;
                    $.each(data, function(i, item) {
                        if($string.includes(item[count]['profanity_word'])){
                            $string = issue.replace('fuck', '****')
                        }

                        count++
                    });
              }
          })
        }


  </script>
</body>
</html>

