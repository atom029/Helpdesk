<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

         $data = \DB::table('history')
                 ->leftjoin('ticket', 'history.history_ticket_id', '=', 'ticket.ticket_id')
                 ->leftjoin('response', 'response.respone_id', '=', 'history.history_response_id')
                 ->leftjoin('department', 'history.history_transfer_department_id', '=', 'department.department_id')
                 ->leftjoin('topic', 'topic.topic_id', '=', 'ticket.ticket_topic')
                 ->leftjoin('priority', 'topic.topic_priority', '=', 'priority.priority_id')
                 ->leftjoin('user', 'history.history_user_id', '=', 'user.user_id')
                ->where('ticket.ticket_id',$id)
                ->get();
        
        // dd($data);
         $count = \DB::table('history')
                 ->leftjoin('ticket', 'history.history_ticket_id', '=', 'ticket.ticket_id')
                 ->leftjoin('response', 'response.respone_id', '=', 'history.history_response_id')
                 ->leftjoin('department', 'history.history_transfer_department_id', '=', 'department.department_id')
                 ->leftjoin('topic', 'topic.topic_id', '=', 'ticket.ticket_topic')
                 ->leftjoin('priority', 'topic.topic_priority', '=', 'priority.priority_id')
                 ->leftjoin('user', 'history.history_user_id', '=', 'user.user_id')
                ->where('ticket.ticket_id',$id)
                ->count();
        $file = \DB::table('file_upload')
                ->where('file_upload.file_upload_ticket_id',$id)
                ->get();


        return view('admin.dynamic.chat')->with('data',$data)->with('file',$file)->with('count',$count);
        
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
        $data  = \DB::table('ticket')
                        ->where('ticket_id',request('ticket_id'))
                        ->update(['ticket_department_id' =>request('department'),'ticket_agent' =>request('agent')]);

        $data = \DB::TABLE('history')->INSERT(
        [               
            'history_ticket_id' => request('ticket_id'), 
            'history_ticket_status' => '0',
            'is_active' => '1', 
            'history_user_id' => request('user_id'),
            'history_response_id' => '0',
            'history_status' => 'transfer',
            'history_department' => request('history_dept'),
            'history_response_id' => '0',
            'history_transfer_department_id' => request('department')
        ]);
            $dept_name =  $data = \DB::table('department')
            ->WHERE('department_id', request('department'))
            ->select('department_name')
            ->get();
            foreach($dept_name as $dept){
                $department_name = $dept->department_name;
            }
            $data = \DB::TABLE('notification')
                ->where('notification_ticket_id', request('ticket_id'))
                ->update(['notification_is_read' => '1']);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => request('ticket_id'),
                'notification_dept_id' => request('department'), 
                'notification_is_read' => '0',
                'notification_summary' => 'Ticket transfered from '.$department_name
            ]);
        
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
         $department = \DB::table('department')
                     ->where('is_active',1)
                     ->get();
        $topic = \DB::table('topic')
                     ->where('is_active',1)
                     ->get();

         $priority = \DB::table('priority')
                     ->get();
              
         $data = \DB::table('history')
                 ->leftjoin('ticket', 'history.history_ticket_id', '=', 'ticket.ticket_id')
                 ->leftjoin('response', 'response.respone_id', '=', 'history.history_response_id')
                 ->leftjoin('department', 'history.history_transfer_department_id', '=', 'department.department_id')
                 ->leftjoin('topic', 'topic.topic_id', '=', 'ticket.ticket_topic')
                 ->leftjoin('priority', 'topic.topic_priority', '=', 'priority.priority_id')
                 ->leftjoin('user', 'history.history_user_id', '=', 'user.user_id')
                ->where('ticket.ticket_id',$id)
                ->get();
                // ->orderby('history_id', 'desc')->first();

        // dd($data);

         $task = \DB::select(\DB::raw("SELECT * FROM `task`
                where task_id not in (SELECT task_id from ticket_task WHERE ticket_task_ticket_id = '$id')"));
                
         
        $task_assigned = \DB::table('ticket_task')
                ->join('task','task.task_id','ticket_task.task_id')
                 ->where('ticket_task.ticket_task_ticket_id',$id)
                 ->get();
        $permission = \DB::table('access_request')
                 ->where('access_request_ticket_id',$id)
                ->where('access_request_agent_id',session('user'))
                 ->where('access_request_approved','1')
                  ->where('access_request_expire','>',Carbon::now())
                 ->count();
         $history = \DB::table('history')
                 ->where('history_ticket_id',$id)
                 ->get();
        // dd($history);
        // dd($data);
        return view('admin.timeline')->with('task',$task)->with('task_assigned',$task_assigned)->with('data',$data)->with('department',$department)->with('topic',$topic)->with('priority',$priority)->with('permission', $permission)->with('history', $history);
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
