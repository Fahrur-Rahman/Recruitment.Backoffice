<?php

namespace App\Http\Controllers;

use App\InterviewClient;
use Illuminate\Http\Request;
use App\Schedule;
use App\Interview;
use App\Rejected;
use App\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewClientController extends Controller
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
        if ($request->status == '3') {
        $validatedData = $request->validate([
            'interviewname' => 'required|nullable',
            'Reject' => 'required|nullable',
            'companyname' => 'required|nullable',
            'interviewnamejobpos' => 'required|nullable',
            'candidateperson' => 'required|nullable',
            'interview' => 'required|nullable',
            'status' => 'required|not_in:0',
            'interviewtime' => 'required|after:today',           
        ],[
            'interviewtime.required'=>'Interview Time field is required',
            'interviewtime.after'=>'Interview Time Date cant back date',
            'status.required'=>'Status field is required',
            'status.not_in'=>'Status field is required',
            'interviewname.required'=>'Interview Name field is required',
            'companyname.required'=>'Company Name field is required',
            'interviewnamejobpos.required'=>'Interview Job Position field is required',
            'candidateperson.required'=>'Personal Candidate Note Person field is required',
            'interview.required'=>'Interview Note field is required',
            'Reject.required'=>'Reject Reason field is required',
        ]);
        } else {
            $validatedData = $request->validate([
                'interviewname' => 'required|nullable',
                'companyname' => 'required|nullable',
                'interviewnamejobpos' => 'required|nullable',
                'candidateperson' => 'required|nullable',
                'interview' => 'required|nullable',
                'status' => 'required|not_in:0',
                'interviewtime' => 'required|after:today',           
            ],[
                'interviewtime.required'=>'Interview Time field is required',
                'interviewtime.after'=>'Interview Time Date cant back date',
                'status.required'=>'Status field is required',
                'status.not_in'=>'Status field is required',
                'interviewname.required'=>'Interview Name field is required',
                'companyname.required'=>'Company Name field is required',
                'interviewnamejobpos.required'=>'Interview Job Position field is required',
                'candidateperson.required'=>'Personal Candidate Note Person field is required',
                'interview.required'=>'Interview Note field is required',
            ]);
        }
        $data = DB::table('schedule')->where('scheduleid', $request->id)->first();
        $tanggal = date('Y-m-d H:i:s', strtotime($request->interviewtime));  
        if ($request->status == '3') {
            
            $schedule = new Schedule;
            $schedule->positionid = $data->positionid;
            $schedule->candidatelistid = $data->candidatelistid;
            $schedule->scheduledate = $tanggal;
            $schedule->save();
            
            $userId = Auth::id();
            $interview = new Interview;
            $interview->interviewid  = $schedule->scheduleid;
            $interview->statusid  = '5';
            $interview->id  = $userId;
            $interview->ctualinterviewtime  = $tanggal;
            $interview->interviewnote  = $request->interview;
            $interview->pesonalcandidatestestimony  = $request->candidateperson;
            $interview->save();

            $interviewclient = new InterviewClient;
            $interviewclient->interviewid  = $schedule->scheduleid;
            $interviewclient->statusclientid = '3';
            $interviewclient->interviewername = $request->interviewname;
            $interviewclient->interviewjobposition = $request->interviewnamejobpos;
            $interviewclient->company = $request->companyname;
            $interviewclient->save();

            $rejected = new Rejected;
            $rejected->rejectreasonid  = $schedule->scheduleid;    
            $rejected->reason = $request->Reject;    
            $rejected->save();
        
            } else {
                $schedule = new Schedule;
                $schedule->positionid = $data->positionid;
                $schedule->candidatelistid = $data->candidatelistid;
                $schedule->scheduledate = $tanggal;
                $schedule->save();
                
                $userId = Auth::id();
                $interview = new Interview;
                $interview->interviewid  = $schedule->scheduleid;
                $interview->statusid  = '5';
                $interview->id  = $userId;
                $interview->ctualinterviewtime  = $tanggal;
                $interview->interviewnote  = $request->interview;
                $interview->pesonalcandidatestestimony  = $request->candidateperson;
                $interview->save();
    
                $interviewclient = new InterviewClient;
                $interviewclient->interviewid  = $schedule->scheduleid;
                $interviewclient->statusclientid = $request->status;
                $interviewclient->interviewername = $request->interviewname;
                $interviewclient->interviewjobposition = $request->interviewnamejobpos;
                $interviewclient->company = $request->companyname;
                $interviewclient->save();
            }
        return redirect('candidatelistschedule');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InterviewClient  $interviewClient
     * @return \Illuminate\Http\Response
     */
    public function show(InterviewClient $interviewClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InterviewClient  $interviewClient
     * @return \Illuminate\Http\Response
     */
    public function edit(InterviewClient $interviewClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InterviewClient  $interviewClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InterviewClient $interviewClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InterviewClient  $interviewClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterviewClient $interviewClient)
    {
        //
    }

    public function form(interview $interview) 
    {   
        $id = $interview;
        $status = DB::table('status')->where('id','<=','3')->get();
        return view ('forminterviewclient', compact('id','status'));
    }
}
