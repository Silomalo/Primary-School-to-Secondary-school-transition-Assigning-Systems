<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignment()
    {
        $totalUsers=count(User::all());
        for($i=1; $i<=$totalUsers; $i++){
            try{
            $users = DB::table('users')
                ->select('*')
                ->where('role', '1')
                ->where('id', $i)
                ->get();
                //echo $users;
             //foreach($users as $users){
                //dd($users);
            
            if($users->isEmpty()){
               
                continue;
            }else{
           foreach($users as $userinfo){
               //dd($userinfo->indexStaffNo);
            $mark = DB::table('marks')
                ->select('*')
                ->where('indexStaffNo', $userinfo->indexStaffNo)
                ->get();

           
           foreach($mark as $marks){
            //dd($marks->indexStaffNo);
               if ($marks->minMark >=400){
                $national1_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('national1');
                $national2_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('national2');
                $national3_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('national3');
                $national4_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('national4');
                  //dd($national2_schoolcode);
                $totalAssigned1=count(Assigned::all()->where('secondarySchoolid',$national1_schoolcode));
                $totalAssigned2=count(Assigned::all()->where('secondarySchoolid',$national2_schoolcode));
                $totalAssigned3=count(Assigned::all()->where('secondarySchoolid',$national3_schoolcode));
                $totalAssigned4=count(Assigned::all()->where('secondarySchoolid',$national4_schoolcode));
                //dd($totalAssigned2);
                $capacity1=Secondary::where('schoolCode', $national1_schoolcode)->value('capacity');
                $capacity2=Secondary::where('schoolCode', $national2_schoolcode)->value('capacity');
                $capacity3=Secondary::where('schoolCode', $national3_schoolcode)->value('capacity');
                $capacity4=Secondary::where('schoolCode', $national4_schoolcode)->value('capacity');
                //dd($capacity2);
                if($totalAssigned1 < $capacity1){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$national1_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    break;
                }else if($totalAssigned2 < $capacity2){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$national2_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save();
                    //echo "National two assigned";
                    break;
                }else if($totalAssigned3 < $capacity3){$store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$national3_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    //echo "National three assigned";
                    break;
                    
                }else if($totalAssigned4 < $capacity4){
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$national3_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    //echo "National four assigned";
                    break;
                }else{
                $schoolchoosen = DB::table('secondaries')
                ->select('*')
                ->where('level', "001")
                ->get();
                foreach($schoolchoosen as $schoolchoosen){
                    //dd($schoolchoosen);
                    //dd($userinfo->primarySchoolID);
                    //dd($marks->indexStaffNo);
                   $sc = $schoolchoosen->schoolCode;
                   $cp = $schoolchoosen->capacity;
                   $totalAssigned=count(Assigned::all()->where('secondarySchoolid',$sc));
                  //dd($totalAssigned);
                   if($totalAssigned < $cp){
                       //echo "Sucess";
                       $store = new Assigned();
                       $store->index=$marks->indexStaffNo;
                       $store->primarySchoolid=$userinfo->primarySchoolID;
                       $store->secondarySchoolid=$sc;
                       $store->scores=$marks->minMark;
                       $store->save(); 
                       break;
                   } else{
                       echo ".";
                   }
                    }
                }
               }else if ($marks->minMark >350){
                $exC1_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('exCounty1');
                $exC2_schoolcode= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('exCounty2');
                
                  //dd($exC1_schoolcode);
                $totalAssigned1=count(Assigned::all()->where('secondarySchoolid',$exC1_schoolcode));
                $totalAssigned2=count(Assigned::all()->where('secondarySchoolid',$exC2_schoolcode));
                
                //dd($totalAssigned2);
                $capacity1=Secondary::where('schoolCode', $exC1_schoolcode)->value('capacity');
                $capacity2=Secondary::where('schoolCode', $exC2_schoolcode)->value('capacity');
               
                //dd($capacity1);

                if($totalAssigned1 < $capacity1){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$exC1_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    break;
                }else if($totalAssigned2 < $capacity2){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$exC2_schoolcode;
                    $store->scores=$marks->minMark;
                    $store->save();
                    //echo "National two assigned";
                    break;
                }else{
                $schoolchoosen = DB::table('secondaries')
                ->select('*')
                ->where('level', "002")
                ->get();
                foreach($schoolchoosen as $schoolchoosen){
                    
                   $sc = $schoolchoosen->schoolCode;
                   $cp = $schoolchoosen->capacity;
                   $totalAssigned=count(Assigned::all()->where('secondarySchoolid',$sc));
                  //dd($totalAssigned);
                   if($totalAssigned < $cp){
                       //echo "Sucess";
                       $store = new Assigned();
                       $store->index=$marks->indexStaffNo;
                       $store->primarySchoolid=$userinfo->primarySchoolID;
                       $store->secondarySchoolid=$sc;
                       $store->scores=$marks->minMark;
                       $store->save(); 
                       break;
                   } else{
                       echo ".";
                   }
                    }
                }
               }else if ($marks->minMark >250){
                $county1Code= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('county1');
                $county2Code= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('county2');
                
                  //dd($exC1_schoolcode);
                $totalAssigned1=count(Assigned::all()->where('secondarySchoolid',$county1Code));
                $totalAssigned2=count(Assigned::all()->where('secondarySchoolid',$county2Code));
                
                //dd($totalAssigned2);
                $capacity1=Secondary::where('schoolCode', $county1Code)->value('capacity');
                $capacity2=Secondary::where('schoolCode', $county2Code)->value('capacity');
               
                //dd($capacity2);
                if($totalAssigned1 < $capacity1){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$county1Code;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    break;
                }else if($totalAssigned2 < $capacity2){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$county2Code;
                    $store->scores=$marks->minMark;
                    $store->save();
                    //echo "National two assigned";
                    break;
                }else{

                $schoolchoosen = DB::table('secondaries')
                ->select('*')
                ->where('level', "003")
                ->get();
                foreach($schoolchoosen as $schoolchoosen){
                    //dd($schoolchoosen);
                    //dd($userinfo->primarySchoolID);
                    //dd($marks->indexStaffNo);
                   $sc = $schoolchoosen->schoolCode;
                   $cp = $schoolchoosen->capacity;
                   $totalAssigned=count(Assigned::all()->where('secondarySchoolid',$sc));
                  //dd($totalAssigned);
                   if($totalAssigned < $cp){
                       //echo "Sucess";
                       $store = new Assigned();
                       $store->index=$marks->indexStaffNo;
                       $store->primarySchoolid=$userinfo->primarySchoolID;
                       $store->secondarySchoolid=$sc;
                       $store->scores=$marks->minMark;
                       $store->save(); 
                       break;
                   } else{
                       echo ".";
                   }
                    }
                }
               }else{
                $districtCode1= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('district1');
                $districtCode2= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('district2');
                
                  //dd($exC1_schoolcode);
                $totalAssigned1=count(Assigned::all()->where('secondarySchoolid',$districtCode1));
                $totalAssigned2=count(Assigned::all()->where('secondarySchoolid',$districtCode2));
                
                //dd($totalAssigned2);
                $capacity1=Secondary::where('schoolCode', $districtCode1)->value('capacity');
                $capacity2=Secondary::where('schoolCode', $districtCode2)->value('capacity');
               
                //dd($capacity1);
                if($totalAssigned1 < $capacity1){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$districtCode1;
                    $store->scores=$marks->minMark;
                    $store->save(); 
                    break;
                }else if($totalAssigned2 < $capacity2){
                    $store = new Assigned();
                    $store->index=$marks->indexStaffNo;
                    $store->primarySchoolid=$userinfo->primarySchoolID;
                    $store->secondarySchoolid=$districtCode2;
                    $store->scores=$marks->minMark;
                    $store->save();
                    //echo "National two assigned";
                    break;
                }else{
                $schoolchoosen = DB::table('secondaries')
                ->select('*')
                ->where('level', "004")
                ->get();
        
                foreach($schoolchoosen as $schoolchoosen){
                         //dd($schoolchoosen);
                         //dd($userinfo->primarySchoolID);
                         //dd($marks->indexStaffNo);
                        $sc = $schoolchoosen->schoolCode;
                        $cp = $schoolchoosen->capacity;
                        $totalAssigned=count(Assigned::all()->where('secondarySchoolid',$sc));
                       //dd($totalAssigned);
                        if($totalAssigned < $cp){
                            //echo "Sucess";
                            $store = new Assigned();
                            $store->index=$marks->indexStaffNo;
                            $store->primarySchoolid=$userinfo->primarySchoolID;
                            $store->secondarySchoolid=$sc;
                            $store->scores=$marks->minMark;
                            $store->save(); 
                            break;
                        } else{
                            echo ".";
                        }
                    }
                }
                    //dd($schoolchoosen); 
          
           }       
        }
    }
        //dd($schoolchoosen[1]);
        
        } 
    } catch (\Illuminate\Database\QueryException $e) {
 
       echo "Already Exits";
    }
    }
    return redirect()->back()->with('success', 'All Students  Placed Succeffuly!');
}
    public function index()
    {   
        //$totalSudents= Seletion::where('indexStaffNo', $userinfo->indexStaffNo)->value('national1');
        $totalStudents=count(User::all()->where('role',"1"));
        $totalHT=count(User::all()->where('role',"2"));
        $totalChoosen=count(Seletion::all());
        $totalPrimaries=count(Primary::all());
        $totalSecondaries=count(Secondary::all());
        $totalPlaced=count(Assigned::all());
        //dd($totalPlaced);
    
        return view('admin.dashboard',[
            'totalStudents' => $totalStudents,
            'totalHT' => $totalHT,
            'totalChoosen' => $totalChoosen,
            'totalPrimaries' => $totalPrimaries,
            'totalSecondaries' => $totalSecondaries,
            'totalPlaced' => $totalPlaced,
        ]); 
    }
    public function addUser()
    {
        $primoID = DB::table('primaries')
                ->select('*')
                ->get();
        return view('admin.addUser',[
            'primoID' => $primoID,
            ]);
    }
    public function storeUser(Request $request)
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

        $user = User::all();
        $userinfo = DB::table('users')
                ->select('*')
                ->get();
        return redirect()->back()   ->with('userinfo', $userinfo)
                                    ->with('success', 'User Added Succeffuly!');
    } catch (\Illuminate\Database\QueryException $e) {
 
                return redirect()->back()->with('error', "BirthCertificate, IndexStaffNo and Email must be Unique");
            }


    }
    public function showUser(Request $request)
    {
        $user = User::all();
        $userinfo = DB::table('users')
                ->select('*')
                ->get();
        return view('admin.showUser',[
            'userinfo' => $userinfo
        ]); 
    }
    public function showPrimary(Request $request)
    {
        $primary = Primary::all();
        $primaryinfo = DB::table('primaries')
                ->select('*')
                ->get();
        return view('admin.showprimary',[
            'primaryinfo' => $primaryinfo
        ]); 
    }
    public function showSecondary(Request $request)
    {
        $secondaryinfo = DB::table('secondaries')
                ->select('*')
                ->get();
        return view('admin.showsecondary',[
            'secondaryinfo' => $secondaryinfo
        ]); 
    }
    public function showScores(Request $request)
    {
        $scores = DB::table('marks')
                ->select('*')
                ->get();
        return view('admin.showmarks',[
            'scores' => $scores
        ]); 
    }
    public function allocated(Request $request)
    {
        $allo = DB::table('assigneds')
                ->select('*')
                ->get();
        return view('admin.showallocated',[
            'allo' => $allo,
        ]); 
    }
    public function searchAllocated(Request $request)
    {
        $index = request()->query('index');
        if($index){
            $allo = DB::table('assigneds')
                    ->select('*')
                    ->where('index', $index)
                    ->get();
            return view('admin.showallocated',[
                        'allo' => $allo
                    ]); 
            }else{
                return redirect()->back();
            } 
    }
    public function searchUser(Request $request)
    {
        $usermail = request()->query('userEmail');
        if($usermail){
            //$fid = Fees::where('facultyid', 'LIKE', "%$facultyid%");
            $userinfo = DB::table('users')
                    ->select('*')
                    ->where('email', $usermail)
                    ->get();
            return view('admin.showUser',[
                        'userinfo' => $userinfo
                    ]); 
            }else{
                return redirect()->back();
            } 
    }
    public function searchSecondary(Request $request)
    {
        $code = request()->query('schoolCode');
        if($code){
            //$fid = Fees::where('facultyid', 'LIKE', "%$facultyid%");
            $secondaryinfo = DB::table('secondaries')
                    ->select('*')
                    ->where('schoolCode', $code)
                    ->get();
            return view('admin.showsecondary',[
                        'secondaryinfo' => $secondaryinfo
                    ]); 
            }else{
                return redirect()->back();
            } 
    }
    public function searchPrimary(Request $request)
    {
        $code = request()->query('schoolCode');
        if($code){
            //$fid = Fees::where('facultyid', 'LIKE', "%$facultyid%");
            $primaryinfo = DB::table('primaries')
                    ->select('*')
                    ->where('schoolCode', $code)
                    ->get();
            return view('admin.showprimary',[
                        'primaryinfo' => $primaryinfo
                    ]); 
            }else{
                return redirect()->back();
            } 
    }
    public function searchMark(Request $request)
    {
        $index = request()->query('index');
        if($index){
            $scores = DB::table('marks')
                    ->select('*')
                    ->where('indexStaffNo', $index)
                    ->get();
            return view('admin.showmarks',[
                        'scores' => $scores
                    ]); 
            }else{
                return redirect()->back();
            } 
    }

    public function addPrimary()
    {
        return view('admin.addPrimary');
    }
    public function addPrimaryFunction(Request $request)
    {
        $primary = new Primary();
        $primary->schoolCode=$request->input('pcode');
        $primary->primaryName=$request->input('pname');
        $primary->county=$request->input('county');
        $primary->subCounty=$request->input('subCounty');
        $primary->role=$request->input('role');
        $primary->capacity=$request->input('capacity');
        $primary->boxNumber=$request->input('boxNumber');
        $primary->email=$request->input('email');
        $primary->save();      
        return redirect()->back()->with('success', 'Primary School Added Succeffuly!');
    }

    public function addSecondary()
    {
        return view('admin.addSecondary');
    }
    public function addSecondaryFunction(Request $request)
    {
        $secondary = new Secondary();
        $secondary->schoolCode=$request->input('scode');
        $secondary->secondaryName=$request->input('sname');
        $secondary->level=$request->input('level');
        $secondary->county=$request->input('county');
        $secondary->subCounty=$request->input('subCounty');
        $secondary->role=$request->input('role');
        $secondary->capacity=$request->input('capacity');
        $secondary->minMark=$request->input('mark');
        $secondary->boxNumber=$request->input('boxNumber');
        $secondary->email=$request->input('email');
    
        $secondary->save();      
        return redirect()->back()->with('success', 'Secondary School Added Succeffuly!');
    }


    public function addMark()
    {
       
        $student = DB::table('users')
                ->select('*')
                ->where('role', "1")
                ->get();
        return view('admin.addMarks',[
            'student' => $student,
            ]);
    }
    public function addMarkFunction(Request $request)
    {
        try{
            $mark = new Mark();
            $mark->indexStaffNo=$request->input('indexNo');
            $mark->minMark=$request->input('mark');
            $mark->save();      
            return redirect()->back()->with('success', 'Mark Added Succeffuly!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "Index Already Exits");
        }
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function updateMarkDetails(Request $request)
    {   
        $id = $request->input('id');
        $index = $request->input('index'); 
        $marks = $request->input('mark'); 
        
        DB::update('update marks set indexStaffNo = ?,minMark = ? where id = ?',
        [$index,$marks,$id]);
            return redirect('/adminshowMarks');
    }
    public function updateSecondaryDetails(Request $request)
    {   
        $id = $request->input('id');
        $code = $request->input('code'); 
        $name = $request->input('name'); 
        $level = $request->input('level'); 
        $county = $request->input('county');
        $subcounty = $request->input('subcounty');
        $role = $request->input('type'); 
        $capacity = $request->input('capacity');
        $min = $request->input('min');  
        $box = $request->input('box');
        $email = $request->input('email');
        
        DB::update('update secondaries set schoolCode = ?,secondaryName = ?,level =?, county = ?,subCounty = ?,role =?, capacity = ?, minMark = ?, boxNumber=?,email=? where id = ?',
        [$code,$name,$level,$county,$subcounty,$role,$capacity, $min, $box,$email,$id]);
            return redirect('/adminshowSecondary');
    }
    public function updatePrimaryDetails(Request $request)
    {   
        $id = $request->input('id');
        $code = $request->input('code'); 
        $name = $request->input('name'); 
        $county = $request->input('county');
        $subcounty = $request->input('subcounty'); 
        $capacity = $request->input('capacity');  
        $box = $request->input('box');
        $email = $request->input('email');
        
        DB::update('update primaries set schoolCode = ?,primaryName = ?,county = ?,subCounty = ?,capacity = ?,boxNumber=?,email=? where id = ?',
        [$code,$name,$county,$subcounty,$capacity,$box,$email,$id]);
            return redirect('/adminshowPrimary');
    }

    public function updateUserDetails(Request $request)
    {   
        $id = $request->input('id');
        $name = $request->input('name'); 
        $birthCertID = $request->input('birthCertID'); 
        $indexStaffNo = $request->input('indexStaffNo');
        $role = $request->input('role'); 
        $primarySchoolID = $request->input('primarySchoolID');  
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $religion = $request->input('religion'); 
        $disabled = $request->input('disabled');
        $email = $request->input('email');
        DB::update('update users set name = ?,birthCertID = ?,indexStaffNo = ?,role = ?,primarySchoolID = ?,gender=?,dob=?,religion = ?,disabled=?, email = ? where id = ?',
        [$name,$birthCertID,$indexStaffNo,$role,$primarySchoolID,$gender,$dob,$religion,$disabled,$email,$id]);
            return redirect('/adminshowusers');
    }
    public function updateMark($id)
    {
        $mark = Mark::find($id);
            $scores = DB::table('marks')
                    ->select('*')
                    ->where('id', $mark->id)
                    ->get();
            return view('admin.updatemark')->with('scores', $scores); 
    }
    public function updateSecondary($id)
    {
        $seco = Secondary::find($id);
            $secondaryinfo = DB::table('secondaries')
                    ->select('*')
                    ->where('id', $seco->id)
                    ->get();
            return view('admin.updatesecondary')->with('secondaryinfo', $secondaryinfo); 
    }
    public function updatePrimary($id)
    {
        $primo = Primary::find($id);
            $primaryinfo = DB::table('primaries')
                    ->select('*')
                    ->where('id', $primo->id)
                    ->get();
            //dd($userinfo);
            return view('admin.updateprimary')->with('primaryinfo', $primaryinfo); 
    }
    public function updateUser($id)
    {
        $user = User::find($id);
            $userinfo = DB::table('users')
                    ->select('*')
                    ->where('id', $user->id)
                    ->get();
            return view('admin.updateUser')->with('userinfo', $userinfo); 
    }
    public function destroyMark($id)
    {
        $mark = Mark::find($id);
        $mark->delete();
        return redirect()->back()->with('error', 'User deleted Succeffuly!');
    }
    public function destroySecondary($id)
    {
        $seco = Secondary::find($id);
        $seco->delete();
        //$retrive= Primary::all();
        return redirect()->back()->with('error', 'User deleted Succeffuly!');
    }
    public function destroyPrimary($id)
    {
        $primo = Primary::find($id);
        $primo->delete();
        $retrive= Primary::all();
        return redirect()->back()->with('error', 'User deleted Succeffuly!');
    }
    public function destroyAllocation($id)
    {
        $allo = Assigned::find($id);
        $allo->delete();
        $retrive= Assigned::all();
        return redirect()->back()->with('error', 'Student Allocation Deleted Succeffuly!');
    }
    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        $retrive= User::all();
        return redirect()->back()->with('error', 'User deleted Succeffuly!');
    }
}
