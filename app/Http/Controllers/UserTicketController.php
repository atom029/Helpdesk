<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = \DB::table('ticket')
                ->join('topic', 'ticket.ticket_topic', '=', 'topic.topic_id')
                ->join('user','ticket.ticket_user_id','user.user_id')
                ->where('user_id',session('user'))
                ->get();
        return view('user.user_ticket')->with(['ticket' => $ticket]);
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
    public function store()
    {
        $user = session('user');
        if(session('is_admin') == 1 || session('is_agent') == 1)
        {
              $notif = \DB::table('notification')
                    ->join('ticket','ticket_id','notification_ticket_id')
                    ->join('emp_department','emp_department_id','ticket_department_id')
                    ->join('topic','ticket_topic','topic_id')
                    ->join('priority','priority_id','topic_priority')
                    ->join('user','user_id','emp_department_user_id')
                    ->where('emp_department_user_id',session('user') )
                    ->where('emp_department_is_active',1)
                    ->where('notification_is_read',0 )
                    ->whereRaw("(ticket_agent = 0 or ticket_agent = '$user')")
                    ->orderBy('topic_priority','desc')
                    ->get();
            return response()->json(['notif' => $notif]);


            
        }
        else
        {
            $notif = \DB::table('notification')
                    ->join('ticket','ticket_id','notification_ticket_id')
                    ->where('notification_user_id',session('user') )
                    ->where('notification_is_read','0' )
                    ->get();
            return response()->json(['notif' => $notif]);
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
