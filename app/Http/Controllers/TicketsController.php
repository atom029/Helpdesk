<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->orderBy('priority_id', 'DESC')

                ->get();

        $unAssigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();

        $mainTicket = \DB::table('sub_ticket')
                        ->join('ticket', 'ticket.ticket_id', '=', 'main_ticket_id')
        ->get();

        $topic = \DB::table('emp_department')
                ->join('user','emp_department_user_id','user_id')
                ->join('department','emp_department_id','department_id')
                ->join('topic','topic_department','department_id')
                ->where('user_id',session('user'))
                ->get(['topic_id','topic_summary']);
        
        
        // dd($assigned);    
        return view('admin.tickets')->with('assigned',$assigned)->with('unAssigned',$unAssigned)->with('data' , 'priority')->with('mainTicket',$mainTicket)->with('topic',$topic);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function serverTicket(Request $request)
    {
        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->orderBy('priority_id', 'DESC')
                ->limit(10)
                ->get();

        $unAssigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();
        $data2 = [];
        foreach ($assigned as $key)
        {
            $data2[] = [
                'ticket_no' => '<span class="email-sender">'.$key->ticket_no.'</span>',
            ];
        }
        return datatables($data2)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $number =  $this->random();
        $department = \DB::TABLE('topic')
                        ->join('department','department_id','topic_department')
                        ->join('priority','priority_id','topic_priority')
                        ->where('topic_id',request('topic'))
                        ->select('department_id','priority_time_resolve','auto_assign','topic_priority')
                        ->get();
        // dd($department);
        foreach ($department as $val) {
            $department_id = $val->department_id;
            $days = $val->priority_time_resolve;
            $auto_assign = $val->auto_assign;
            $priority = $val->topic_priority;
        }

        


        $date_add = Carbon::now()->addDays($days);
        
        $date = $this->holiday($date_add);

        $user_exist = \DB::TABLE('user')->where('user_email',request('email'))->count();
        
        $user_id = '';
        if($user_exist > 0){
            $user_id = \DB::TABLE('user')->where('user_email',request('email'))->get('user_id');
            foreach($user_id as $val){
                $user_id = $val->user_id;
            }
            if($auto_assign == 1)
            {
                $assignedAgent = $this->getAgent($department_id);
                \DB::TABLE('ticket')->INSERT(
                [               
                'ticket_topic' => request('topic'), 
                'ticket_summary' => request('summary'),
                'ticket_details' => request('issue'),
                'ticket_no' => $number,
                'ticket_user_id' => $user_id,
                'ticket_department_id' => $department_id,
                'ticket_date' => $date,
                'is_read_admin' => 0,
                'is_read_user' => 1,
                'ticket_agent' => $assignedAgent,
                'ticket_priority' => $priority
                ]);
                $ticket_id = \DB::getPdo()->lastInsertId();
            }
            else{
                \DB::TABLE('ticket')->INSERT(
            [               
                'ticket_topic' => request('topic'), 
                'ticket_summary' => request('summary'),
                'ticket_details' => request('issue'),
                'ticket_no' => $number,
                'ticket_user_id' => $user_id,
                'ticket_department_id' => $department_id,
                'ticket_date' => $date,
                'is_read_admin' => 0,
                'is_read_user' => 1,
                'ticket_agent' => 0,
                'ticket_priority' => $priority
                ]);
                $ticket_id = \DB::getPdo()->lastInsertId();
            }
            
            $data = \DB::TABLE('history')->INSERT(
            [               
                'history_ticket_id' => $ticket_id, 
                'history_ticket_status' => '0',
                'is_active' => '1', 
                'history_user_id' => $user_id,
                'history_response_id' => '0',
                'history_status' => 'open',
                'history_department' => $department_id,
                'history_transfer_department_id' => '0'
              
            ]);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => $ticket_id,
                'notification_dept_id' => $department_id, 
                'notification_is_read' => '0',
                'notification_summary' => 'New Ticket'
            ]);

            return response()->json(['data' => $number]);
        }
        else{
            \DB::TABLE('user')->INSERT(
            [               
                'user_email' => request('email'), 
                'user_is_approved' => '0', 
                'user_contact_no' => request('contact_no'),
                'user_is_admin' => '0', 
                'user_fname' => request('fname'),
                'user_lname' => request('mname'),
                'user_mname' => request('lname'),
            ]);
            $user_id = \DB::getPdo()->lastInsertId();
            if($auto_assign == 1)
            {
                $assignedAgent = $this->getAgent($department_id);
                \DB::TABLE('ticket')->INSERT([               
                'ticket_topic' => request('topic'), 
                'ticket_summary' => request('summary'),
                'ticket_details' => request('issue'),
                'ticket_department_id' => $department_id,
                'ticket_no' => $number,
                'ticket_user_id' => $user_id,
                'ticket_agent' => $assignedAgent,
                'ticket_date' => $date,
                'is_read_admin' => 0,
                'is_read_user' => 1,
                'ticket_priority' => $priority
            ]);
            $ticket_id = \DB::getPdo()->lastInsertId();
            }
            else{
               \DB::TABLE('ticket')->INSERT([               
                'ticket_topic' => request('topic'), 
                'ticket_summary' => request('summary'),
                'ticket_details' => request('issue'),
                'ticket_department_id' => $department_id,
                'ticket_no' => $number,
                'ticket_user_id' => $user_id,
                'ticket_agent' => 0,
                'ticket_date' => $date,
                'is_read_admin' => 0,
                'is_read_user' => 1,
                'ticket_priority' => $priority
            ]);
            $ticket_id = \DB::getPdo()->lastInsertId();
            }
            
            \DB::TABLE('history')->INSERT(
            [               
                'history_ticket_id' => $ticket_id, 
                'history_ticket_status' => '0',
                'is_active' => '1', 
                'history_user_id' => $user_id,
                'history_response_id' => '0',
                'history_status' => 'open',
                'history_transfer_department_id' => '0'
            ]);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => $ticket_id,
                'notification_dept_id' => $department_id, 
                'notification_is_read' => '0',
                'notification_summary' => 'New Ticket'
            ]);
            

            return response()->json(['data' => $number]);
        }



       
        
        
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ticket_history = \DB::table('ticket')
                ->join('history', 'history.history_ticket_id', '=', 'ticket.ticket_id')
                
                ->where('ticket_no', request('ticket'))
                ->whereRaw('(history_status = "open" or history_status = "admin answer" or history_status = "transfer" or history_status = "closed")')
                 
                ->orderBy('history_id', 'asc')

                ->get();

        return response()->json(['ticket_history' => $ticket_history]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function random()
    {
        $number = rand();
        $count = \DB::TABLE('ticket')->where('ticket_no',$number)->count();
        if($count < 1)
        {
            return $number;
        }
        else{
            return $this->random();
        }
        
    }

  


    public function holiday($is_holiday)
    {

        $date = $is_holiday;
        $date_name = $date->format('l');
        
        if($date_name == "Saturday"){
            $date = $date->addDays(2);
        }
        if($date_name == "Sunday"){
            $date = $date->addDays(1);
        }

        $dates = $date->toDateString();
        $holidays = \DB::TABLE('holiday')
                        ->whereBetween('holiday_date',[Carbon::now()->toDateString(),$dates])
                        ->count();
        $pass = $date->addDays($holidays);
        
        return $pass;
        
      
    }

    public function getAgent($department)
    {

        


         $users = \DB::select(\DB::raw("select user_id from user 
                JOIN emp_department on emp_department_user_id = user_id
                where user_id not in (select ticket_agent from ticket WHERE ticket_department_id = '$department')
                and emp_department_id = '$department'
                and emp_department_is_active = 1
                GROUP by user_id
                order BY sla desc limit 1"));
         $user_count = count($users);
         if($user_count == 1)
         {
            foreach($users as $val)
            {
                $agent =  $val->user_id;
            }
            return $agent;
         }
         else
         {
            $ticket = \DB::table('emp_department')
                ->join('ticket','ticket_agent','emp_department_user_id')
                ->join('user','user_id','emp_department_user_id')
                ->where('emp_department_id',$department)
                ->where('emp_department_is_active','1')
                ->where('ticket_status','!=',"'closed'")
                ->groupBy('ticket_agent')
                ->orderByRaw("tickets asc,sla desc")
                ->limit(1)
                ->selectRaw('ticket_agent,count(*) as tickets')
                ->get();

            foreach ($ticket as $val) {
                $agent = $val->ticket_agent;
            }
            // dd($agent);
            return $agent;
         }

       
        
      
    }

    public function dateCreated()
    {
        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->orderBy('ticket.ticket_created_at','asc')

                ->get();

        $unAssigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', '0')
                ->orderBy('ticket.ticket_created_at','asc')

                ->get();
        $mainTicket = \DB::table('sub_ticket')
                        ->join('ticket', 'ticket.ticket_id', '=', 'main_ticket_id')
        ->get();
         $topic = \DB::table('emp_department')
                ->join('user','emp_department_user_id','user_id')
                ->join('department','emp_department_id','department_id')
                ->join('topic','topic_department','department_id')
                ->where('user_id',session('user'))
                ->get(['topic_id','topic_summary']);
        // dd($ticket);    
        // return Redirect::to('admin.tickets')->with('ticket', $ticket);
        return view('admin.tickets')->with('assigned',$assigned)->with('unAssigned',$unAssigned)->with('data' , 'date')->with('mainTicket',$mainTicket)->with('topic',$topic);
    }

    public function unread()
    {

        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->where('is_read_admin', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();

        $unAssigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','!=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', '0')
                ->where('is_read_admin', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();
       $mainTicket = \DB::table('sub_ticket')
                        ->join('ticket', 'ticket.ticket_id', '=', 'main_ticket_id')
        ->get();


         $topic = \DB::table('emp_department')
                ->join('user','emp_department_user_id','user_id')
                ->join('department','emp_department_id','department_id')
                ->join('topic','topic_department','department_id')
                ->where('user_id',session('user'))
                ->get(['topic_id','topic_summary']);
        // dd($ticket);    
        // return Redirect::to('admin.tickets')->with('ticket', $ticket);
        return view('admin.tickets')->with('assigned',$assigned)->with('unAssigned',$unAssigned)->with('data' , 'unread')->with('mainTicket',$mainTicket)->with('topic',$topic);
    }

    public function closed()
    {

        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->where('is_read_admin', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();

        $unAssigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('ticket_status','=', 'closed')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', '0')
                ->where('is_read_admin', '0')
                ->orderBy('priority_id', 'DESC')

                ->get();
       $mainTicket = \DB::table('sub_ticket')
                        ->join('ticket', 'ticket.ticket_id', '=', 'main_ticket_id')
        ->get();

        dd($assigned);
        // dd($ticket);    
        // return Redirect::to('admin.tickets')->with('ticket', $ticket);
        return view('admin.tickets')->with('assigned',$assigned)->with('unAssigned',$unAssigned)->with('data' , 'unread')->with('mainTicket',$mainTicket);
    }


    
    public function subTicket(Request $request)
    {

     $number =  $this->random();
        $department = \DB::TABLE('topic')
                        ->join('department','department_id','topic_department')
                        ->join('priority','priority_id','topic_priority')
                        ->where('topic_id',request('topic'))
                        ->select('department_id','priority_time_resolve','auto_assign')
                        ->get();
        // dd($department);
        foreach ($department as $val) {
            $department_id = $val->department_id;
            $days = $val->priority_time_resolve;
            $auto_assign = $val->auto_assign;
        }

        


        $date_add = Carbon::now()->addDays($days);
        
        $date = $this->holiday($date_add);

        
        \DB::TABLE('ticket')->INSERT(
        [               
        'ticket_topic' => request('topic'), 
        'ticket_summary' => request('summary'),
        'ticket_details' => request('issue'),
        'ticket_no' => $number,
        'ticket_user_id' => session('user'),
        'ticket_department_id' => $department_id,
        'ticket_date' => $date,
        'is_read_admin' => 0,
        'is_read_user' => 1,
        'ticket_agent' => request('agent'),
        'ticket_priority' =>  request('priority'),
        ]);
        $ticket_id = \DB::getPdo()->lastInsertId();
    
       
        
        $data = \DB::TABLE('history')->INSERT(
        [               
            'history_ticket_id' => $ticket_id, 
            'history_ticket_status' => '0',
            'is_active' => '1', 
            'history_user_id' => session('user'),
            'history_response_id' => '0',
            'history_status' => 'open',
            'history_department' => $department_id,
            'history_transfer_department_id' => '0'
          
        ]);
        $data = \DB::TABLE('notification')->INSERT(
        [               
            'notification_ticket_id' => $ticket_id,
            'notification_dept_id' => $department_id, 
            'notification_is_read' => '0',
            'notification_summary' => 'New Ticket'
        ]);
        $data = \DB::TABLE('sub_ticket')->INSERT(
        [               
            'ticket_id_sub' => $ticket_id,
            'main_ticket_id' => request('mainTicket')
        ]);

        return response()->json(['data' => $number]);
        



       
        
        
    }

    public function dept_agent($id)
    {
         $dept = \DB::table('topic')
                 ->join('department','topic_department','department_id')
                ->where('topic_id',$id)
                ->get();
        foreach ($dept as $key) {
            $dept_id = $key->department_id;
            break;
        }
        $user = \DB::table('user')
                 ->join('emp_department','emp_department_user_id','user_id')
                 ->where('emp_department_id',$dept_id)
                ->where('emp_department_is_active',1)
                ->get();

        // dd($user);
         return response()->json(['user' => $user]);
    }

    public function requestAccess(Request $request)
    {
          $data = \DB::TABLE('access_request')->INSERT(
        [               
            'access_request_agent_id' => session('user'),
            'access_request_ticket_id' => request('ticket_id'), 
            'access_request_reason' => request('reason'),
          
        ]);
        // dd($user);
         return response()->json(['user' => $data]);
    }
    
}
