<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ticket, $task)
    {
        
        $data = \DB::table('history')
                 ->leftjoin('ticket', 'ticket_id', '=', 'history_ticket_id')
                 ->leftjoin('response', 'respone_id', '=', 'history_response_id')
                 ->leftjoin('ticket_task', 'ticket_task_id', '=', 'history_ticket_task_id')
                 ->leftjoin('task', 'task.task_id', '=', 'history_ticket_task_id')
                ->where('history.history_ticket_id',$ticket)
                ->where('history.history_ticket_task_id',$task)
                ->get();
        
        // dd($data);
        $file = \DB::table('file_upload')
                ->where('file_upload.file_upload_ticket_id',$ticket)
                ->get();    
        return view('admin.dynamic.task_chat')->with('data',$data)->with('file',$file);
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
       $data =  \DB::TABLE('ticket_task')
                ->INSERT([               
                    'ticket_task_ticket_id' => request('ticket_id'), 
                    'task_id' => request('task_id')
                ]);
         $data = \DB::TABLE('history')->INSERT(
        [               
            'history_ticket_id' => request('ticket_id'), 
            'history_ticket_status' => '0',
            'is_active' => '1', 
            'history_user_id' => session('user'),
            'history_response_id' => '0',
            'history_status' => 'task assigned',
            'history_department' => request('history_dept'),
            'history_transfer_department_id' => '0',
            'history_ticket_task_id' => request('task_id')
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

    public function insertTaskResponse(Request $request)
    {
        \DB::TABLE('response')
        ->INSERT(
        [               
            'response_ticket_id' => request('ticket_id'), 
            'response_issue' => request('reply'), 
            'respone_task_id' => request('task'), 
            'response_user_id' => request('user_id')
        ]);
        $response_id = \DB::getPdo()->lastInsertId();
        

        \DB::TABLE('history')->INSERT(
        [               
            'history_ticket_id' => request('ticket_id'), 
            'history_ticket_status' => '0',
            'is_active' => '1', 
            'history_user_id' => session('user'),
            'history_response_id' => $response_id,
            'history_status' => 'task answer',
            'history_department' => request('history_dept'),
            'history_transfer_department_id' => '0',
            'history_ticket_task_id' => request('task')
        ]);
        $history = \DB::getPdo()->lastInsertId();
        session(['history_id' => $history]);
       
       
        
        return response()->json(['data' => session('history_id')]);
    }
    
}
