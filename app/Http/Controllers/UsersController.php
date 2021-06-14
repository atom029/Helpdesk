<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('user')->get();
        return view('admin.add_user')->with('data',$data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blank = \DB::table('user')
         ->where('user_email','test@gmail.com')
         ->whereNull('user_password')
         ->count();
        if($blank > 0)
        {
             $data = \DB::TABLE('user')
                ->where('user_email',  request('email'))
                ->update(['user_username' => request('email'),'user_password' => Hash::make(request('password'))]);
       


        return response()->json(['data' => 'success']);
        }
        else{
             \DB::TABLE('user')
        ->INSERT(
            [               
                'user_email' => request('email'), 
                'user_contact_no' => request('contact_no'),
                'user_username' => request('username'),
                'user_password' => Hash::make(request('password')), 
                'user_is_active' => request('is_active'),
                'user_is_approved' => request('is_approve'),
                'user_is_admin' => request('is_admin'),
                'user_is_agent' => request('is_agent'),
                'user_fname' => request('fname'),
                'user_lname' => request('lname'),
                'user_mname' => request('mname')
            ]);
        return response()->json(['data' => 'success']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


     public function agent()
    {
        $data = \DB::table('user')
                ->where('user_is_agent', 1)
                ->orWhere('user_is_admin', 1)
                ->get();

        

        return view('admin.agent')->with('data',$data);
    }

    public function agentInfo(Request $request)
    {
        $user = request('user_id');
        $open  = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                
                ->where('emp_department_user_id',  request('user_id'))

                ->where('emp_department_is_active', '1')
                ->whereRaw("ticket_status != 'closed' and (ticket_agent = $user or ticket_agent = 0)")
                ->orderBy('priority_id', 'DESC')

                ->count();
        $overdue = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                
                ->where('ticket_date','<', Carbon::now())
                ->where('emp_department_user_id',  request('user_id'))
                ->where('emp_department_is_active', '1')
                ->whereRaw("ticket_status != 'closed' and (ticket_agent = $user or ticket_agent = 0)")
                ->orderBy('priority_id', 'DESC')

                ->count();
        $answered = \DB::table('history')
                ->where('history_status','!=', 'open')
                ->where('history_user_id', request('user_id'))
                ->distinct('history_ticket_id')
                ->count();
        $closed = \DB::table('ticket')
                ->whereRaw("ticket_status = 'closed' and (ticket_agent = $user)")
                ->count();

        $tickets_answered = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', request('user_id'))
                ->where('history_status', 'admin answer')
                ->count();
        $tickets_overdue = \DB::table('ticket')
                ->where('ticket_agent', request('user_id'))
                ->where('ticket_date', '<',Carbon::now())
                ->where('ticket_status', '!=' ,"'Answered'")
                ->where('ticket_status','!=' ,"'closed'")
                ->count();

        // dd($tickets_answered);
        if($tickets_answered == 0 )
        {
            $sla = 0;
        }
        else{
            $sla = (($tickets_answered / ($tickets_answered + $tickets_overdue))) * 100;    
        }
        $sla = round($sla, 2);
        
        // dd($sla);

        $data = \DB::TABLE('user')
                ->where('user_id',  session('user'))
                ->update(['sla' => $sla]);

        return response()->json(['open' => $open ,'overdue' => $overdue ,'answered' => $answered ,'closed' => $closed,'sla'=>$sla]);
    }
}
