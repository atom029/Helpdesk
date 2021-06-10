<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = \DB::table('department')->get();
         $user = \DB::table('user')->where('user_is_agent','1')->get();
         return view('admin.department')->with('data',$data)->with('user',$user);;
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
        $data = \DB::TABLE('department')
        ->INSERT(
            [               
                'department_name' => request('dept_name'), 
                'department_desc' => request('dept_desc')
            ]);
        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dept_id = request('department_id');
        $data =  $data = \DB::table('user')
                        ->where('user_is_agent', '1')
                        ->get(); 
        $emp_assign  = \DB::table('emp_department')
                        ->join('user','user_id','emp_department_user_id')
                        ->join('department','department_id','emp_department_id')
                        ->where('department_id', $dept_id)
                        ->get(); 

        return response()->json(['data' => $data,'emp' => $emp_assign]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDept(Request $request )
    {
         $dept  = \DB::table('department')
                      
                        ->where('department_id', request('department_id'))
                        ->get();
         return response()->json(['dept' => $dept]);
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
        $exist = \DB::table('emp_department')
                ->where('emp_department_id',request('department_id'))
                ->where('emp_department_user_id',request('emp_id'))
                ->count();
        if($exist == 1)
        {
            $data  = \DB::table('emp_department')
                        ->where('emp_department_id',request('department_id'))
                        ->where('emp_department_user_id',request('emp_id'))
                        ->update(['emp_department_is_active' => request('status')]);
        }
        else
        {
            $data = \DB::TABLE('emp_department')
            ->INSERT(
            [               
                'emp_department_id' => request('department_id'), 
                'emp_department_user_id' => request('emp_id')
            ]);
        }
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

    public function updateDepartment(Request $request){
        $data  = \DB::table('department')
                        ->where('department_id',request('dept_id'))
                        
                        ->update(['department_name' => request('dept_name'),'department_desc' => request('dept_desc')]);
        return response()->json(['data' => $data]);
    }
}
