

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Agent Performance</title>
     <div align="center">
        <figure>
            <img src="" alt="Republic of the Philippines" width="100px" />
            <figcaption>Polytechnic University of the Philippines</figcaption>
             <figcaption style="text-align: center"><b style="text-decoration: underline;">PUP Support System</b></figcaption><br>
             <figcaption>List of Tickets Generated By The System.</figcaption>
        </figure>
         
    </div>
    <div class="row" style="padding:4px; background-color: #666666; margin-bottom: 4px; "></div>
    <style>
    .text-right {
        text-align: right;
    }
    
    </style>
   
     
</head>
    
   
   
<body style="background: white">

    <div class="panel-body">
      <!-- FIRST ROW -->
      <p style="font-size: 18px">
         
      </p>

      <style>
      table, td, th{
          border: 1px solid black;
          border-collapse: collapse;
      }
      .borderless{
          border-bottom: 0px;
          border-left: 0px;
          border-right: 0px;
          border-top:0px;
          border-collapse: separate;
      }
      </style>
     @php $i = 0
     @endphp
     @foreach($performance as $val)

      <p><b>Agent:</b> {{ $performance[$i]['user_name'] }}</p>
      <p><b>Open Ticket:</b> {{$performance[$i]['open']}}</p>
      <p><b>Overdue Ticket:</b> {{ $performance[$i]['overdue'] }}</p>
      <p><b>Answered Ticket:</b> {{$performance[$i]['answered']}}</p>
      <p><b>Closed Ticket:</b>{{$performance[$i]['closed']}} </p>
       <p><b>Sla: </b>{{$performance[$i]['sla']}}% </p>

    <br>
       <table style="font-size: 15px; width: 100%;" border="1" cellpadding="5">
          <thead style="text-align:center" >
              <tr>
                 <th colspan="3"> Priority </th>
                  <th colspan="3"> Ticket No </th>
                  <th colspan="3"> Summary </th>
                  <th colspan="3"> Date Created </th>
                
                  <th colspan="3"> Ticket Status </th>

                  <th colspan="3"> Due Date</th>
                  
                  
              </tr>
          </thead>
          <tbody>
            

            @foreach($assigned as $row)
                @if($performance[$i]['user_id'] == $row->ticket_agent)
                  <tr>
                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->priority_name }}</td>
                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->ticket_no }}</td>
                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->ticket_summary }} </td>
                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->created_at }}</td>

                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->ticket_status }}</td>
                      <td colspan="3" style=" text-align: center; width:13%">{{ $row->ticket_date }}</td>

                  </tr>
              @endif
            @endforeach
            {{$i++}}
        </tbody>                                 
    </table>
     <br>
     @endforeach
    
</div><br>
    <div class="row" style="padding:4px; background-color: #666666; margin-bottom: 4px; "></div>
     <div class="" style="font-size: 17px; font-family: arial; text-align: center">
        <br>
        <br>
       
     </div>
     <!-- end panel-body -->
     <div class="panel" style="text-align: center">
        <b>Generated by</b><br><br>
        <p style="font-family: arial">
          @foreach($created_by as $val)
            <u>{{ $val->user_fname }} {{ $val->user_lname }}</u>
          @endforeach
          <br>
          Name<br><br>
          <u><?php echo date('F d, Y');?></u>
          <br>
          Date
        </p>
     </div>
</div>
<!-- END TABLE -->

</body>
</html>

<script type="text/javascript"> 
</script>
<!--  <label><b>CERTIFICATION</b></label>
        <p style="margin: 20px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        I hereby certify on my official oath that the foregoing is a correct and complete record of all residents.
        </p> -->