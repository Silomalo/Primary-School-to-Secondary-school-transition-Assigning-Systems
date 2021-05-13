<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Primary;
use App\Models\Assigned;
use App\Models\Secondary;
use App\Models\Seletion;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentSendsms(Request $request)
    {
        $users = User::find(Auth::id());
        $sms = new Message();
        $sms->sender=$users->indexStaffNo;
        $sms->primarySchoolcode=$request->input('pid');
        $sms->receiver=$request->input('target');
        $sms->messageBody=$request->input('txt');
        $sms->save();      
        return redirect()->back()->with('success', 'Message Send Succeffuly!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminShowMessage()
    {
        $users = User::find(Auth::id());
        //dd($users->indexStaffNo);
        //$sms= Message::where([['receiver','=','3'],['sender','=',$users->indexStaffNo ]])->first();
        $sms = DB::table('messages')
                ->select('*')
                ->where('receiver','3')
                ->orWhere('sender', $users->indexStaffNo)
                ->get();
        return view('admin.showMessage',[
            'sms' => $sms
        ]); 
    }
    public function adminReply($id)
    {
      
        $replyTo = DB::table('messages')
                ->select('*')
                ->where('id',$id)
                ->get();
        //dd($replyTo);
        return view('admin.reply',[
            'replyTo' => $replyTo,
        ]); 
    }
    public function HTReply($id)
    {
      
        $replyTo = DB::table('messages')
                ->select('*')
                ->where('id',$id)
                ->get();
        //dd($replyTo);
        return view('headTeacher.reply',[
            'replyTo' => $replyTo,
        ]); 
    }
    public function adminSendReply(Request $request)
    {
        $users = User::find(Auth::id());
        $sms = new Message();
        $sms->sender=$users->indexStaffNo;
        $sms->primarySchoolcode=$request->input('pcode');
        $sms->receiver=$request->input('receiver');
        $sms->messageBody=$request->input('txt');
        $sms->save();      
        return redirect("/adminshowMessages")->with('success', 'Message Send Succeffuly!');
    }
    public function htSendReply(Request $request)
    {
        $users = User::find(Auth::id());
        $sms = new Message();
        $sms->sender=$users->indexStaffNo;
        $sms->primarySchoolcode=$request->input('pcode');
        $sms->receiver=$request->input('receiver');
        $sms->messageBody=$request->input('txt');
        $sms->save();      
        return redirect("/myMessages")->with('success', 'Message Send Succeffuly!');
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
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
    public function HDdestroysms($id)
    {
        $sms = Message::find($id);
        $sms->delete();
        $retrive= Message::all();
        return redirect()->back()->with('error', 'SMS deleted Succeffuly!');
    }
    public function studestroysms($id)
    {
        $sms = Message::find($id);
        $sms->delete();
        $retrive= Message::all();
        return redirect()->back()->with('error', 'SMS deleted Succeffuly!');
    }
    public function destroysms($id)
    {
        $sms = Message::find($id);
        $sms->delete();
        $retrive= Message::all();
        return redirect()->back()->with('error', 'SMS deleted Succeffuly!');
    }
}
