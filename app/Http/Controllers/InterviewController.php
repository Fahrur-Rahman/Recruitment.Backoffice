<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\CandidateList;
use App\Schedule;
use App\Rejected;
use App\Position;
use App\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
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
        if ($request->statusidint == '3') {
            $validatedData = $request->validate([
                'testimony' => 'required|nullable',
                'personal' => 'required|nullable',
                'rejectnote' => 'required|nullable',
                'statusidint' => 'required|min:0|not_in:0',
            ],[
                'testimony.required'=>'Interview Testimony field is required',
                'statusidint.required'=>'Personal Testimony is required',
                'statusidint.not_in'=>'Status field is required',
                'statusidint.required'=>'Status field is required',
                'rejectnote.required'=>'Reject Reason Reason field is required',
            ]);

        $userId = Auth::id();
        $interview = new Interview;
        $interview->interviewid  = $request->scid;
        $interview->statusid  = $request->statusidint;
        $interview->id  = $userId;
        $interview->ctualinterviewtime  = $request->sdate;
        $interview->interviewnote  = $request->testimony;
        $interview->pesonalcandidatestestimony  = $request->personal;
        $interview->save();

        $rejected = new Rejected;
        $rejected->rejectreasonid  = $request->scid;    
        $rejected->reason = $request->rejectnote;    
        $rejected->save();
        return redirect('schedule');
        } else {
            $validatedData = $request->validate([
                'testimony' => 'required|nullable',
                'personal' => 'required|nullable',
                'statusidint' => 'required|numeric|min:0|not_in:0',
            ],[
                'statusidint.not_in'=>'Status field is required',
                'statusidint.required'=>'Status field is required',
                'testimony.required'=>'Interview Testimony field is required',
                'personal.required'=>'Personal Testimony is required','rejectnote.required'=>'Reject Reason Reason field is required',
            ]);
            

        $userId = Auth::id();
        $interview = new Interview;
        $interview->interviewid  = $request->scid;
        $interview->statusid  = $request->statusidint;
        $interview->id  = $userId;
        $interview->ctualinterviewtime  = $request->sdate;
        $interview->interviewnote  = $request->testimony;
        $interview->pesonalcandidatestestimony  = $request->personal;
        $interview->save();
        }
        return redirect('schedule');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interviewdata)
    {   
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
