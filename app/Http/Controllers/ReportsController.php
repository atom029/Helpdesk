<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class ReportsController extends Controller
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
                ->whereRaw("ticket_status != 'closed' and ticket_agent = '$user'")
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
                ->whereRaw("ticket_status != 'closed' and ticket_agent = $user")
                ->orderBy('priority_id', 'DESC')

                ->count();
        $answered = \DB::table('history')
                ->where('history_status','=', 'admin answer')
                ->where('history_user_id',session('user'))
                ->distinct('history_ticket_id')
                ->count();
        $closed = \DB::table('ticket')
                ->whereRaw("ticket_status = 'closed' and ticket_agent = $user ")
                ->count();
         $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->where('ticket_agent', session('user'))
                ->orderBy('priority_id', 'DESC')

                ->get();
        $created_by = \DB::table('user')
                    ->where( 'user_id', session('user'))
                    ->get();
        $tickets_answered = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', session('user'))
                ->where('history_status', 'admin answer')
                ->count();
        $tickets_overdue = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', session('user'))
                ->where('history_status','Overdue')
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
        // dd($tickets_overdue);
        $view = View('admin.printables.performance')->with('assigned',$assigned)->with('open',$open)->with('overdue',$overdue)->with('answered',$answered)->with('closed',$closed)->with('created_by',$created_by)->with('sla',$sla);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allAgentPerformance()
    {
        $dt = Carbon::now();
        $dt->toDateString();
        $user = \DB::table('user')
         ->whereRaw("user_is_agent = 1")
        ->select('user_id','user_fname','user_lname',)
        ->get();
        $performance = [];
         foreach ($user as $key) {
             $open  = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                
                ->where('emp_department_user_id', session('user'))

                ->where('emp_department_is_active', '1')
                ->whereRaw("ticket_status != 'closed' and ticket_agent = '$key->user_id'")
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
                ->whereRaw("ticket_status != 'closed' and ticket_agent = '$key->user_id'")
                ->orderBy('priority_id', 'DESC')

                ->count();
             $tickets_answered = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', $key->user_id)
                ->where('history_status', 'admin answer')
                ->count();
        $tickets_overdue = \DB::table('ticket')
                ->join('history','ticket_id','history_ticket_id')
                ->where('ticket_agent', $key->user_id)
                ->where('history_status','Overdue')
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
           $answered = \DB::table('history')
                ->where('history_status','=', 'admin answer')
                ->where('history_user_id',$key->user_id)
                ->distinct('history_ticket_id')
                ->count();
            $closed = \DB::table('ticket')
                    ->whereRaw("ticket_status = 'closed' and ticket_agent = '$key->user_id' ")
                    ->count();
             $performance[] = [
                'user_id' => $key->user_id,
                'user_name' => $key->user_fname.' '.$key->user_lname,
                'open' => $open,
                'overdue' => $overdue,
                'answered' => $answered,
                'closed' => $closed,
                'sla' => $sla,
            ];
            
        }
        $assigned = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('priority','priority_id','topic_priority')
                ->join('emp_department','emp_department.emp_department_id','ticket.ticket_department_id')
                ->join('department', 'department.department_id', 'emp_department.emp_department_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('emp_department_user_id', session('user'))
                ->where('emp_department_is_active', '1')
                ->orderBy('priority_id', 'DESC')

                ->get();
        
        // dd($assigned);
        $created_by = \DB::table('user')
                    ->where( 'user_id', session('user'))
                    ->get();
        $view = View('admin.printables.agentPerformance')->with('performance',$performance)->with('assigned',$assigned)->with('created_by',$created_by)->with('sla',$sla);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->stream();
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
