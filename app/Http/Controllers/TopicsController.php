<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('department')->select('department_id','department_name')->get();
        $topic = \DB::table('topic')
                ->join('department', 'topic.topic_department', '=', 'department.department_id')
                ->join('priority', 'priority.priority_id', '=', 'topic.topic_priority')
                ->where('topic.is_active','1')
                ->get();
        return view('admin.topic')->with('data',$data)->with('topic', $topic);
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
        \DB::TABLE('topic')
        ->INSERT(
            [               
                'topic_summary' => request('topic'), 
                'topic_type' => request('type'), 
                'topic_priority' => request('priority'),
                'topic_department' => request('department'), 
                'is_active' => request('is_active'),
                'auto_assign' => request('auto_assign'),
            ]);
        return response()->json(['data' => 'success']);
    }

    public function updateTopic(Request $request)
    {
        $data  = \DB::table('topic')
                        ->where('topic_id',request('topic_id'))
                        ->update(['topic_summary' => request('topic'),'topic_priority'=>request('priority'),'topic_department'=>request('department'),'auto_assign'=>request('auto_assign')]);
        return response()->json(['data' => 'success']);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTopic(Request $request)
    {
         $topic = \DB::table('topic')
                ->join('department', 'topic.topic_department', '=', 'department.department_id')
                ->join('priority', 'priority.priority_id', '=', 'topic.topic_priority')
                ->where('topic_id',request('topic'))
                ->get();
        return response()->json(['data' => $topic]);
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
    public function deleteTopic(Request $request)
    {
         $data  = \DB::table('topic')
                        ->where('topic_id',request('topic'))
                        ->update(['is_active' => '0']);
         return response()->json(['data' => $data]);
    }
}
