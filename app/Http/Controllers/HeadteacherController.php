<?php

namespace App\Http\Controllers;

use App\Models\Headteacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Primary;
use App\Models\Assigned;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HeadteacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $totalStudents=count(User::all()->where('primarySchoolID',$user->primarySchoolID));
        $name=Primary::where('schoolCode',$user->primarySchoolID)->value('primaryName');
        $totalChoosen=count(Assigned::all()->where('primarySchoolid',$user->primarySchoolID));
    
        //dd($totalChoosen);
    
        return view('headTeacher.home',[
            'totalStudents' => $totalStudents,
            'name' => $name,
            'totalChoosen' => $totalChoosen,

        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = User::find(Auth::id());
        $totalStudents=count(User::all()->where('primarySchoolID',$user->primarySchoolID));
        $name=Primary::where('schoolCode',$user->primarySchoolID)->value('primaryName');
        $totalChoosen=count(Assigned::all()->where('primarySchoolid',$user->primarySchoolID));
    
        //dd($totalChoosen);
    
        return view('headTeacher.home',[
            'totalStudents' => $totalStudents,
            'name' => $name,
            'totalChoosen' => $totalChoosen,

        ]); 
    }
    public function addStudent()
    {
        $primoID = DB::table('primaries')
                ->select('*')
                ->get();
        return view('headTeacher.addStudent',[
            'primoID' => $primoID,
            ]);
    }
    public function storeStudent(Request $request)
    {
        try{
        $user = new User();
        $user->name=$request->input('name');
        $user->birthCertID=$request->input('birthCertID');
        $user->indexStaffNo=$request->input('indexStaffNo');
        $user->role=$request->input('role');
        $user->primarySchoolID=$request->input('primarySchoolID');
        $user->gender=$request->input('gender');
        $user->dob=$request->input('dob');
        $user->religion=$request->input('religion');
        $user->disabled=$request->input('disabled');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->save();      
        return redirect()->back()->with('success', 'Student Added Succeffuly!');
    } catch (\Illuminate\Database\QueryException $e) {
 
        return redirect()->back()->with('error', "BirthCertNo, IndexNo and Email must be Unique");
    }

    }
    public function studentList()
    {
        $user = User::find(Auth::id());

        $placed = DB::table('assigneds')
            ->select('*')
            ->where('primarySchoolid',$user->primarySchoolID)
            ->get();
    //dd($stuName);
    return view('headTeacher.showSelected',[
            'placed' => $placed,
        ]);
    }
    public function hdMessages()
    {
        $user = User::find(Auth::id());

        $sms = DB::table('messages')
            ->select('*')
            ->where('receiver', "2")
            ->orWhere('sender',$user->indexStaffNo)
            ->get();
    //dd($stuName);
    return view('headTeacher.sms',[
            'sms' => $sms,
        ]);
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
     * @param  \App\Models\Headteacher  $headteacher
     * @return \Illuminate\Http\Response
     */
    public function show(Headteacher $headteacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Headteacher  $headteacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Headteacher $headteacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Headteacher  $headteacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Headteacher $headteacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Headteacher  $headteacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headteacher $headteacher)
    {
        //
    }
}
