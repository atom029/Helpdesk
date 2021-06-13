<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('topic')->where('topic.is_active','1')->get();
        return view('index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.register');
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
    public function checkUser($user)
    {
     $count = \DB::table('user')
         ->where('user_username',$user)

       
        ->count();
    if($count > 0)
    {
        $blank = \DB::table('user')
         ->where('user_username',$user)
         ->where('user_password','!=' ,'')
       
        ->count();
        if($blank > 0)
            return response()->json(['count' =>'2']);
        else
            return response()->json(['count' =>'1']);
    }  
   
         
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

    public function checkCred(Request $request)
    {
        $dt = Carbon::now();
        $dt->toDateString();
        $overdue = \DB::table('ticket')
         ->whereRaw("(ticket_status != 'closed' and ticket_status != 'Overdue') and ticket_date <= '$dt'")
        ->select('ticket_id','ticket_department_id')
        ->get();
        // dd($overdue);
        foreach ($overdue as $key) {
            \DB::TABLE('response')
            ->INSERT(
            [               
                'response_ticket_id' => $key->ticket_id, 
                'response_issue' => 'Flag as overdue by the system' ,
                'response_user_id' => '0'
            ]);
            $data = \DB::TABLE('ticket')
                ->where('ticket_id',  $key->ticket_id)
                ->update(['ticket_status' => 'Overdue']);
            $data = \DB::TABLE('history')->INSERT(
            [               
                'history_ticket_id' => $key->ticket_id, 
                'history_ticket_status' => '0',
                'is_active' => '1', 
                'history_user_id' => '0',
                'history_response_id' => '0',
                'history_status' => 'Overdue',
                'history_department' => '0',
                'history_transfer_department_id' => '0',
                'history_response_id' => '0'
            ]);
            $data = \DB::TABLE('notification')->INSERT(
            [               
                'notification_ticket_id' => $key->ticket_id, 
                'notification_dept_id' => $key->ticket_department_id,   
                'notification_is_read' => '0',
                'notification_summary' => 'Flag as overdue by the system'
            ]);
        }

        $user =  \DB::table('user')
        ->WHERE('user_username', request('username'))
        ->WHERE('user_is_active', '1')
        ->select('user_password')
        ->get();
        foreach ($user as $key) {
            $password = $key->user_password;
        }
        if(count($user) > 0)
        {
        // echo ($user);
        
        if (Hash::check(request('password'),$password)) {
            
            $data = \DB::table('user')
            ->WHERE('user_username', request('username'))
            ->WHERE('user_is_active', '1')
            ->select('user_id', 'user_is_admin','user_fname','user_lname','user_is_agent')
            ->get();
            foreach($data as $val)
            {
                session(['user' => $val->user_id]);
                session(['user_name' => $val->user_fname . ' ' . $val->user_lname]);
                session(['is_admin' => $val->user_is_admin]);
                session(['is_agent' => $val->user_is_agent]);
            }

            \DB::TABLE('user')
                ->where('user_id', session('user'))
                ->update(['is_online' => '1']);

            return response()->json(['data' =>$data]);
        }
        }
        else{
             return response()->json(['data' =>'0']);
        }

    }

    public function login()
    {
       return view('admin.login');

    }

    public function logout(){
         \DB::TABLE('user')
                ->where('user_id', session('user'))
                ->update(['is_online' => '0']);
        Session::forget('user');
        Session::forget('name');
        $data = \DB::table('topic')->get();
        return view('index')->with('data',$data);
        
    }

    public function multifileupload()
    {
        return view('user.upload');
    }

    public function stores(Request $request)
    {
        
        $image = $request->file('file');
        $ticket_id = $request->input('ticket_id');
        $imageName = $image->getClientOriginalName();
        $upload_success = $image->move(public_path('upload/'.session('user').'/'.$request->input('ticket_id')),$imageName);
        $data = \DB::TABLE('file_upload')->INSERT(
        [               
            'file_upload_history_id' => session('history_id'), 
            'file_upload_name' => $imageName,
            'file_upload_ticket_id' => $ticket_id
            
        ]);
        if ($upload_success) {
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }

   

     public function getTicketInfo(Request $request){
        $data = \DB::table('ticket')
                ->where('ticket_id','37')
                ->get();
            return response()->json(['response' => $data]);
        
    }

    
}
