<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('user')->get();
        return view('admin.add_user')->with('data',$data);
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
        $blank = \DB::table('user')
         ->where('user_email','test@gmail.com')
         ->whereNull('user_password')
         ->count();
        if($blank > 0)
        {
             $data = \DB::TABLE('user')
                ->where('user_email',  request('email'))
                ->update(['user_username' => request('email'),'user_password' => Hash::make(request('password'))]);
       


        return response()->json(['data' => 'success']);
        }
        else{
             \DB::TABLE('user')
        ->INSERT(
            [               
                'user_email' => request('email'), 
                'user_contact_no' => request('contact_no'),
                'user_username' => request('username'),
                'user_password' => Hash::make(request('password')), 
                'user_is_active' => request('is_active'),
                'user_is_approved' => request('is_approve'),
                'user_is_admin' => request('is_admin'),
                'user_is_agent' => request('is_agent'),
                'user_fname' => request('fname'),
                'user_lname' => request('lname'),
                'user_mname' => request('mname')
            ]);
        return response()->json(['data' => 'success']);
        }

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
