<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class SendEmailController extends Controller
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

    public function checkTicket(Request $request)
    {
       $exist = \DB::table('ticket')
                 ->leftjoin('user', 'user_id',  'ticket_user_id')
                 ->where('ticket.ticket_no',request('ticket'))
                 ->where('user_email',request('email'))
                ->count();
       
        return response()->json(['data' => $exist]);
    }


    public function sendFullConvo(Request $request){
        $ticket = \DB::table('ticket')->where('ticket.ticket_no',request('ticket'))
                ->get();
        foreach ($ticket as $key) {
            $tickets = $key->ticket_id;
        }
        $data = \DB::table('history')
                 ->leftjoin('ticket', 'history.history_ticket_id', '=', 'ticket.ticket_id')
                 ->leftjoin('response', 'response.respone_id', '=', 'history.history_response_id')
                 ->leftjoin('department', 'history.history_transfer_department_id', '=', 'department.department_id')
                 ->leftjoin('topic', 'topic.topic_id', '=', 'ticket.ticket_topic')
                 ->leftjoin('priority', 'topic.topic_priority', '=', 'priority.priority_id')
                 ->leftjoin('user', 'history.history_user_id', '=', 'user.user_id')
                ->where('ticket.ticket_id',$tickets)
                ->get();
        // dd($data);
        $file = \DB::table('file_upload')
                ->where('file_upload.file_upload_ticket_id',$tickets)
                ->get();
            Mail::send('email', 
                [
                    "data1"=>$data
                    ,"file"=>$file
                ],
                function($message)
                {   
                     $message->from('PupSupport@gmail.com','PUP | Support')
                    ->to(request('email'),request('email'))
                    ->subject('Ticket Update');
                });
            
            return response()->json(['response' => "1"]);
       
    }
}
