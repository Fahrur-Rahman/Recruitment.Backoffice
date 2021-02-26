<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Position;
use App\Rejected;
use App\Interview;
use App\CandidateList;
use App\Link;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\ValidationException;

use App\Schedule;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        if (CandidateList::where('niknumber', '=', $request->nik)->exists()) {
            throw ValidationException::withMessages(['nik' => 'NIK already exist']);
         }
         else{
            $validatedData = $request->validate([
                'nik' => 'required|nullable|digits:16|numeric',
                'fullname' => 'required|nullable',
                'email' => 'required|nullable|email',
                'phonenumber' => 'required|nullable|numeric|digits_between:11,13', 
                'position' => 'required|not_in:0',
                'scheduledate' => 'required|after:today',           
            ],[
                'nik.required'=>'NIK field is required',
                'nik.exists'=>'NIK already exist',
                'nik.digits'=>'NIK more than less 16 digits',
                'nik.numeric'=>'NIK must be a number',
                'fullname.required'=>'Full Name field is required',
                'email.required'=>'Email field is required',
                'email.email'=>'Email is not valid',
                'phonenumber.required'=>'Phone Number field is required',
                'phonenumber.numeric'=>'Phone Number must be a number',
                'phonenumber.digits_between'=>'Phone Number is not valid',
                'position.required'=>'Position field is required',
                'position.not_in'=>'Position field is required',
                'scheduledate.after'=>'Schedule Date cant back date',
                'scheduledate.required'=>'Schedule Date field is required',
            ]);
         }   

        $tanggal = date('Y-m-d H:i:s', strtotime($request->scheduledate));
        $candidatelist = new CandidateList;
        $candidatelist->fullname = $request->fullname;
        $candidatelist->niknumber = $request->nik;
        $candidatelist->email = $request->email;
        $candidatelist->mobilephone = $request->phonenumber;    
        $candidatelist->save();

        $id = position::select('positionid')->where('positionname',$request->position)->first();

        $schedule = new Schedule;
        $schedule->positionid = $id->positionid;
        $schedule->candidatelistid = $candidatelist->candidatelistid;
        $schedule->scheduledate = $tanggal;
        $schedule->save();

        return redirect('schedule');

        // $schedule = $candidatelist->schedule()->create($schedule,$position);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {   
        $validatedData = $request->validate([
            // 'nik' => 'required|nullable|digits:16|numeric',
            'fullname' => 'required|nullable',
            'email' => 'required|nullable|email',
            'phone' => 'required|nullable|numeric|digits_between:11,13', 
            'position' => 'required|not_in:0',           
        ],[
            'nik.required'=>'NIK field is required',
            'nik.digits'=>'NIK more than less 16 digits',
            'nik.numeric'=>'NIK must be a number',
            'fullname.required'=>'Full Name field is required',
            'email.required'=>'Email field is required',
            'email.email'=>'Email is not valid',
            'phone.required'=>'Phone Number field is required',
            'phone.numeric'=>'Phone Number must be a number',
            'phone.digits_between'=>'Phone Number is not valid',
            'position.required'=>'Position field is required',
            'position.not_in'=>'Position field is required',
        ]);
        $candidatelistsave = DB::table('candidatelist')->where('candidatelistid', $request->cli)
        ->update([
            "fullname"     => $request->fullname,
            "niknumber"      => $request->nik,
            "email"        => $request->email,
            "mobilephone"        => $request->phone,
        ]);

        $schedulesave = DB::table('schedule')->where('scheduleid', $request->si)
        ->update([
            "positionid"     => $request->position,
            "candidatelistid"      => $request->cli,
        ]);
        



        // $schedulesave = DB::table('schedule')->where('scheduleid', $schedule->scheduleid)->update(array('positionid' => $id->positionid))
        // ->update(array('candidatelistid' => $schedule->candidatelistid))
        // ->update(array('scheduledate' => $schedule->scheduledate));

        // $candidatelistsave = new CandidateList;
        // $candidatelistsave->candidatelistid = $candidatelist->candidatelistid;
        // $candidatelistsave->fullname = $candidatelist->fullname;
        // $candidatelistsave->niknumber = $candidatelist->niknumber;
        // $candidatelistsave->email = $candidatelist->email;
        // $candidatelistsave->mobilephone = $candidatelist->mobilephone;    
        // $candidatelistsave->save();

        // $id = position::select('positionid')->where('positionname',$position->positionname)->first();

        // $schedulesave = new Schedule;
        // $schedulesave->scheduleid = $schedule->scheduleid;
        // $schedulesave->positionid = $id->positionid;
        // $schedulesave->candidatelistid = $candidatelistsave->candidatelistid;
        // $schedulesave->scheduledate = $schedule->scheduledate;
        // $schedulesave->save();

        return redirect('schedule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    // public function coba(Request $request)
    // {
       
    //     $cari = $request->positionname;
 
    //     $id = position::select('positionid')->where('positionname',$request->positionname)->first();
    //     dd($id->positionid);
    // }

    public function reschedule(Request $request)
    {   
        $validatedData = $request->validate([
            'reschedulereason' => 'required|nullable',
        ]);

        $schedule = DB::table('schedule')->where('scheduleid', '=', $request->resi)->first();
        $candidatelist = DB::table('candidatelist')->where('candidatelistid', '=', $request->reci)->first();
        $position = DB::table('position')->where('positionname',$request->reposition)->first();
        $candidatelistsave = DB::table('candidatelist')->where('candidatelistid', $candidatelist->candidatelistid)
        ->update([
            "fullname"     => $request->rename,
            "niknumber"      => $request->renik,
            "email"        => $request->reemail,
            "mobilephone"        => $request->rephone,
        ]);
        
        $schedulesave = DB::table('schedule')->where('scheduleid', $schedule->scheduleid)
        ->update([
            "positionid"     => $position->positionid,
            "isreschedule"  => "1",
            "scheduledate"  => $request->rescheduledate,
            "reasonreschedule"  => $request->reschedulereason,
            "candidatelistid"      => $request->reci,
        ]);



        // $schedulesave = DB::table('schedule')->where('scheduleid', $schedule->scheduleid)->update(array('positionid' => $id->positionid))
        // ->update(array('candidatelistid' => $schedule->candidatelistid))
        // ->update(array('scheduledate' => $schedule->scheduledate));

        // $candidatelistsave = new CandidateList;
        // $candidatelistsave->candidatelistid = $candidatelist->candidatelistid;
        // $candidatelistsave->fullname = $candidatelist->fullname;
        // $candidatelistsave->niknumber = $candidatelist->niknumber;
        // $candidatelistsave->email = $candidatelist->email;
        // $candidatelistsave->mobilephone = $candidatelist->mobilephone;    
        // $candidatelistsave->save();

        // $id = position::select('positionid')->where('positionname',$position->positionname)->first();

        // $schedulesave = new Schedule;
        // $schedulesave->scheduleid = $schedule->scheduleid;
        // $schedulesave->positionid = $id->positionid;
        // $schedulesave->candidatelistid = $candidatelistsave->candidatelistid;
        // $schedulesave->scheduledate = $schedule->scheduledate;
        // $schedulesave->save();

        return redirect('schedule');
    }

    public function link(Schedule $schedule)
    {   
        $ada = DB::table('candidatelink')->where('candidatelistid', '=' ,$schedule->candidatelistid)->first();
        if(!empty($ada) > 0){
            $schedulecandidateinterview = DB::table('schedule')->where('scheduleid', '=', $schedule->scheduleid)->first();
            $candidateinformation = DB::table('candidatelist')->where('candidatelistid', '=', $schedulecandidateinterview->candidatelistid)->first();
            $canid = DB::table('candidatelink')->where('candidatelistid', '=', $schedulecandidateinterview->candidatelistid)->first();

            $id = DB::table('schedule')
            ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
            ->where('candidatelistid', '=', $schedule->candidatelistid)->get();

            $history = DB::table('schedule')->where('candidatelist', '=', $schedule->candidatelistid)
            ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
            ->whereNull('interviewid');

            $candidatelist = DB::table('candidatelist')
            ->where('candidatelistid',$schedule->candidatelistid)->first();
            
            $candidatelistschedule = DB::table('schedule')
            ->where('candidatelistid',$schedule->candidatelistid)
            ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
            ->join('status', 'status.id', '=', 'interview.statusid')
            ->join('users', 'users.id', '=', 'interview.id')
            ->get();
            return view ('interview', compact('schedulecandidateinterview','candidateinformation','canid','history','candidatelistschedule','candidatelist'));
        }else{
            $schedule = DB::table('schedule')->where('scheduleid', '=', $schedule->scheduleid)->first();
            $candidatelist = DB::table('candidatelist')->where('candidatelistid', '=', $schedule->candidatelistid)->first();
            $candidate = DB::table('candidate')->where('fullname', 'like', '%' . $candidatelist->fullname . '%')
            ->orWhere('nik', 'like', '%' . $candidatelist->niknumber . '%')
            ->orWhere('phonenumber', 'like', '%' . $candidatelist->mobilephone . '%')
            ->orWhere('email', 'like', '%' . $candidatelist->email . '%')
            ->get();
            return view ('linked', compact('candidatelist','candidate','schedule'));
        }
        
        // $schedule = DB::table('schedule')->where('scheduleid', '=', $schedule->scheduleid)->first();
        // $candidatelist = DB::table('candidatelist')->where('candidatelistid', '=', $schedule->candidatelistid)->first();
        // $candidate = DB::table('candidate')->where('fullname', 'like', '%' . $candidatelist->fullname . '%')
        // ->orWhere('nik', 'like', '%' . $candidatelist->niknumber . '%')
        // ->orWhere('phonenumber', 'like', '%' . $candidatelist->mobilephone . '%')
        // ->orWhere('email', 'like', '%' . $candidatelist->email . '%')
        // ->get();
        // return view ('linked', compact('candidatelist','candidate','schedule'));
    
    }

    public function nonew(Request $request)
    {   
        
        // $candidatelist = new CandidateList;
        // $candidatelist->fullname = $request->fullname;
        // $candidatelist->niknumber = $request->nik;
        // $candidatelist->email = $request->email;
        // $candidatelist->mobilephone = $request->phonenumber;    
        // $candidatelist->save();
        $validatedData = $request->validate([
            'notnewcandidatelist' => 'required|not_in:0',  
            'notnewcandidateposition' => 'required|not_in:0',
            'notscheduledate' => 'required|after:today',
        ],[
            'notnewcandidatelist.not_in'=>'Candidate List field is required',
            'notnewcandidateposition.not_in'=>'Position field is required',
            'notscheduledate.after'=>'Schedule Date cant back date',
            'notscheduledate.required'=>'Schedule Date field is required',
        ]);
        
        $tanggal = date('Y-m-d H:i:s', strtotime($request->notscheduledate));   

        $schedule = new Schedule;
        $schedule->positionid = $request->notnewcandidateposition;
        $schedule->candidatelistid = $request->notnewcandidatelist;
        $schedule->scheduledate = $tanggal;
        $schedule->save();

        return redirect('schedule');

        // $schedule = $candidatelist->schedule()->create($schedule,$position);
    }

    public function getcandidatelistno($candidatelistid) 
    {        
        $states = DB::table("candidatelist")->where("candidatelistid",$candidatelistid)->first();
        return json_encode($states);
    }

    public function notattend(Request $request)
    {   
        $validatedData = $request->validate([
            'notattendreason' => 'required',  
        ],[
            'notattendreason.required'=>'Not Attend Reason List field is required',
        ]);
        
        $userId = Auth::id();
        $interview = new Interview;
        $interview->interviewid  = $request->noattsi;
        $interview->statusid  = '4';
        $interview->id  = $userId;
        $interview->ctualinterviewtime  = date('Y-m-d H:i:s');
        $interview->save();

        $rejected = new Rejected;
        $rejected->rejectreasonid  = $request->noattsi;    
        $rejected->reason = $request->notattendreason;    
        $rejected->save();
        return view('/schedule');
    }
    public function formnewyes() 
    {        
        $posisi = Position::all();
        return view ('newcandidateschedule', compact('posisi'));
    }

    public function formnewno() 
    {        
        $posisi = Position::all();
        $modalcandidatelist = CandidateList::all();
        return view ('nonewcandidateschedule', compact('posisi','modalcandidatelist'));
    }

    public function editnewcandidateschedule(schedule $schedule) 
    {     
        $candidatelist = DB::table('candidatelist')->where('candidatelistid',$schedule->candidatelistid)->first();
        $positionselect = DB::table('position')->where('positionid',$schedule->positionid)->first();
        $posisi = Position::all();
        return view ('editnewcandidateschedule', compact('schedule','positionselect','posisi','candidatelist'));
    }

    public function notattendview(schedule $schedule) 
    {   
        $schedulecandidate = DB::table('schedule')
        ->join('candidatelist', 'candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
        ->join('position', 'position.positionid', '=', 'schedule.positionid')       
        ->where('scheduleid', '=', $schedule->scheduleid)->first();

        return view ('notattend', compact('schedulecandidate'));
    }



}
