<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = session('user');
        $open  = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                
                ->where('emp_department_user_id', session('user'))

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
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->whereRaw("ticket_status != 'closed' and (ticket_agent = $user or ticket_agent = 0)")
                ->orderBy('priority_id', 'DESC')

                ->count();
        $answered = \DB::table('history')
                ->where('history_status','!=', 'open')
                ->where('history_user_id',session('user'))
                ->distinct('history_ticket_id')
                ->count();
        $closed = \DB::table('ticket')
                ->whereRaw("ticket_status = 'closed' and (ticket_agent = $user or ticket_agent = 0)")
                ->count();
        $tickets_assigned = \DB::table('ticket')
                ->where('ticket_agent', session('user'))
                ->count();
        $tickets_answered = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', session('user'))
                ->where('history_status', 'admin answer')
                ->count();
        $tickets_overdue = \DB::table('ticket')
                ->where('ticket_agent', session('user'))
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
       

        $open_priority = \DB::select(\DB::raw("SELECT priority_id,COUNT(topic_priority) as ticket_count FROM `ticket`
                left JOIN topic on ticket_topic = topic_id
                left JOIN priority on priority_id = topic_priority
                WHERE  (ticket_agent = '$user'
                or ticket_agent = 0)
                and ticket_status != 'closed'
                GROUP BY priority_id"));

        $priority = \DB::select(\DB::raw("SELECT priority_id,priority_name FROM priority"));

        $donut = '';
        $check = 0;
        foreach ($priority as $key) {
            foreach ($open_priority as $val ) {
               if($key->priority_id == $val->priority_id)
               {
                    $donut .= "{label:'".$key->priority_name."', value:$val->ticket_count},";
                    $check = 1;    
               }

            }
            if($check == 0){
                $donut .= "{label:'".$key->priority_name."', value:0},";
            }
            $check =0;
        }

        $donut = substr($donut, 0,-1);
        
        $chart = '';

        $check = 0;
        
        $ticket = \DB::select(\DB::raw("SELECT date(ticket_created_at) as ass_created,count(*) as ass_count from ticket
                    WHERE ticket_agent = '$user' or ticket_agent = 0
                    GROUP by date(ticket_created_at)"));
        $ans = \DB::select(\DB::raw("SELECT date(created_at) as ans_created,count(*) as ans_count FROM `history`
                WHERE history_user_id = '$user'
                AND history_status = 'admin answer'
                GROUP BY date(created_at)"));

        foreach ($ticket as $key) {
            foreach ($ans as $val) {
                if($key->ass_created == $val->ans_created){
                     $chart .= "{date:'".$key->ass_created."', asscount:$key->ass_count,anscount:$val->ans_count},";
                    $check = 1;
                }
            }
            if($check == 0){
                $chart .= "{date:'".$key->ass_created."', asscount:$key->ass_count,anscount:0},";
            }
            $check =0;
        }
        $chart = substr($chart, 0,-1);
   
        return view('admin.dashboard')->with('open',$open)->with('overdue',$overdue)->with('answered',$answered)->with('closed',$closed)->with('sla',$sla)->with('chart',$chart)->with('donut',$donut);
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
        //
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
}
