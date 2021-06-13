<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reopen($ticket)
    {

        $data = \DB::TABLE('ticket')
                ->where('ticket_id', $ticket)
                ->update(['ticket_status' => 'Reopen','ticket_date' => Carbon::now()->addDays(2)]);
        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = \DB::table('ticket')
                ->where('ticket_id',request('ticket_id'))
                ->select('ticket_priority','ticket_date')
                ->get();
        foreach ($ticket as $key ) {
            $prio = $key->ticket_priority;
            $ticket_date = $key->ticket_date;
        }
        $assigned = \DB::table('priority')
                ->where('priority_id', $prio)
                ->select('priority_reply_time')
                ->get();
        foreach ($assigned as $key ) {
            $date = $key->priority_reply_time;
        }
        $date = Carbon::now()->addDays($date);
        \DB::TABLE('response')
        ->INSERT(
        [               
            'response_ticket_id' => request('ticket_id'), 
            'response_issue' => request('reply'), 
            'response_user_id' => request('user_id')
        ]);
        $response_id = \DB::getPdo()->lastInsertId();
        $count = \DB::table('history')
            ->where('history_ticket_id',request('ticket_id'))
            ->where('history_status','admin answer')
            ->count();

        if(session('is_admin') == 1 || session('is_agent') == 1){
            if($count == 0){
                $data = \DB::TABLE('ticket')
                    ->where('ticket_id', request('ticket_id'))
                    ->update(['ticket_status' => 'Answered','ticket_date' => $date,'is_answered' => 1]);
                 $data = \DB::TABLE('history')->INSERT(
                [               
                    'history_ticket_id' => request('ticket_id'), 
                    'history_ticket_status' => '0',
                    'is_active' => '1', 
                    'history_user_id' => request('user_id'),
                    'history_response_id' => '0',
                    'history_status' => 'admin answer',
                    'history_department' => request('history_dept'),
                    'history_transfer_department_id' => '0',
                    'history_response_id' => $response_id
                ]);
                 session(['history_id' => \DB::getPdo()->lastInsertId()]);
                
            }
            else{
                $data = \DB::TABLE('ticket')
                    ->where('ticket_id', request('ticket_id'))
                    ->update(['ticket_status' => 'Answered','ticket_date' => $date]);
                $data = \DB::TABLE('history')->INSERT(
                [               
                    'history_ticket_id' => request('ticket_id'), 
                    'history_ticket_status' => '0',
                    'is_active' => '1', 
                    'history_user_id' => request('user_id'),
                    'history_response_id' => '0',
                    'history_status' => 'admin reply',
                    'history_department' => request('history_dept'),
                    'history_transfer_department_id' => '0',
                    'history_response_id' => $response_id
                ]);
                session(['history_id' => \DB::getPdo()->lastInsertId()]);
                
            }
        }
        else{
           
                $data = \DB::TABLE('ticket')
                    ->where('ticket_id', request('ticket_id'))
                    ->update(['ticket_status' => 'Answered','ticket_date' => $date]);
                 $data = \DB::TABLE('history')->INSERT(
                [               
                    'history_ticket_id' => request('ticket_id'), 
                    'history_ticket_status' => '0',
                    'is_active' => '1', 
                    'history_user_id' => request('user_id'),
                    'history_response_id' => '0',
                    'history_status' => 'user reply',
                    'history_department' => request('history_dept'),
                    'history_transfer_department_id' => '0',
                    'history_response_id' => $response_id
                ]);
                 session(['history_id' => \DB::getPdo()->lastInsertId()]);
                
            

           
        }
        
        if(session('is_admin') == 1 || session('is_agent') == 1){
             $data = \DB::TABLE('notification')
                ->where('notification_ticket_id', request('ticket_id'))
                ->update(['notification_is_read' => '1']);
            \DB::TABLE('ticket')
                ->where('ticket_id', request('ticket_id'))
                ->update(['is_read_user' => '0','is_read_admin' => '1','is_answered' => 1]);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => request('ticket_id'),
                'notification_user_id' => request('creator_user_id'), 
                'notification_is_read' => '0',
                'notification_summary' => request('reply')
            ]);

           
        }
        else{
            $data = \DB::TABLE('notification')
                ->where('notification_ticket_id', request('ticket_id'))
                ->update(['notification_is_read' => '1']);
             \DB::TABLE('ticket')
                ->where('ticket_id', request('ticket_id'))
                ->update(['is_read_admin' => '0','is_read_user' => '1']);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => request('ticket_id'),
                'notification_dept_id' => request('history_dept'), 
                'notification_is_read' => '0',
                'notification_summary' => request('reply')
            ]);
        }
       
        
        return response()->json(['data' => $data]);

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
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $data = \DB::TABLE('history')->INSERT(
        [               
            'history_ticket_id' => request('ticket_id'), 
            'history_ticket_status' => '0',
            'is_active' => '1', 
            'history_user_id' => request('user_id'),
            'history_response_id' => '0',
            'history_status' => 'closed',
            'history_department' => request('history_dept'),
            'history_transfer_department_id' => '0',
        ]);
         \DB::TABLE('notification')
            ->where('notification_ticket_id', request('ticket_id'))
            ->update(['notification_is_read' => '1']);
        \DB::TABLE('notification')->INSERT(
        [               
            'notification_ticket_id' => request('ticket_id'),
            'notification_user_id' => request('creator_user_id'), 
            'notification_is_read' => '0',
            'notification_summary' => 'Ticket Closed'
        ]);
         $data = \DB::TABLE('ticket')
                ->where('ticket_id', request('ticket_id'))
                ->update(['ticket_status' => 'closed']);

        return response()->json(['data' => $data]);
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
