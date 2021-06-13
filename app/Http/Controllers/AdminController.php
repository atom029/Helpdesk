<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class AdminController extends Controller
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
                ->where('ticket_status','open')
                ->orwhere('ticket_status','Reopen')
                ->orwhere('ticket_status','Overdue')
                ->count();
        $overdue = \DB::table('ticket')
                ->join('history', 'ticket.ticket_id', '=', 'history.history_ticket_id')
                
                ->where('ticket_date','<', Carbon::now())
                ->whereRaw("(history_status != 'closed' or history_status != 'answer' or history_status != 'admin answer' or history_status !=  'closed' or history_status !=  'transfered')")
                ->groupby('history_ticket_id')
                ->count();
        $answered = \DB::table('history')
                ->where('history_status', 'admin answer')
                ->distinct('history_ticket_id')
                ->count();
        $closed = \DB::table('ticket')
                ->whereRaw("ticket_status = 'closed'")
                ->count();
        $open_priority = \DB::select(\DB::raw("SELECT priority_id,COUNT(topic_priority) as ticket_count FROM `ticket`
                left JOIN topic on ticket_topic = topic_id
                left JOIN priority on priority_id = topic_priority
                
                and ticket_status != 'closed'
                GROUP BY priority_id"));

        $dept_count = \DB::select(\DB::raw("SELECT ticket_department_id,COUNT(*) as ticket_count FROM `ticket`
                GROUP BY ticket_department_id"));
        $department = \DB::select(\DB::raw("select department_id,department_name from department"));
         // dd($department);
        $bar = '';
        $check = 0;
        foreach ($department as $key) {
            foreach ($dept_count as $val) {
                if($val->ticket_department_id == $key->department_id)
                {
                    $bar .= "{label:'".$key->department_name."', value:$val->ticket_count},";
                    $check = 1;
                }
            }
            if($check == 0){
                $bar .= "{label:'".$key->department_name."', value:0},";
            }
             $check =0;
        }
        $bar = substr($bar, 0,-1);

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
        $ticket = \DB::select(\DB::raw("SELECT date(ticket_created_at) as ass_created,count(*) as ass_count from ticket
                   
                    GROUP by date(ticket_created_at)"));
        $ans = \DB::select(\DB::raw("SELECT date(created_at) as ans_created,count(*) as ans_count FROM `history`
                
                where history_status = 'admin answer'
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
        return view('admin.adminDashboard')->with('open',$open)->with('overdue',$overdue)->with('answered',$answered)->with('closed',$closed)->with('donut',$donut)->with('chart',$chart)->with('bar',$bar)->with('sla',$sla);
    
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
