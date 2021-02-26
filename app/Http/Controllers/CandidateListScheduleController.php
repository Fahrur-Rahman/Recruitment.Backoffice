<?php

namespace App\Http\Controllers;

use App\Position;
use App\History;
use App\User;
use App\Schedule;
use App\CandidateList;
use App\CandidateListSchedule;
use App\Interview;
use App\Rejected;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CandidateListScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $candidatelistschedule = DB::table('interview')
        ->select('fullname','interviewid','status','ctualinterviewtime','jml')
        ->join('status', 'status.id', '=', 'interview.statusid')
        ->join(DB::raw("( SELECT `fullname`, count(`interviewid`) as `jml`, max(`interviewid`) as `idint` FROM `candidatelist` t1
        inner join `schedule` on `schedule`.`candidatelistid` = `t1`.`candidatelistid`
        inner join `interview` on `interview`.`interviewid` = `schedule`.`scheduleid` group by (`fullname`)) as `t2`"), function($join){
            $join->on("interview.interviewid", "=", "t2.idint");
        })->paginate();
        // DB::enableQueryLog(); 
        // $candidatelistschedule = DB::table('candidatelist')
        // ->join('schedule', 'schedule.candidatelistid', '=', 'candidatelist.candidatelistid')
        // ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
        // ->join('status', 'status.id', '=', 'interview.statusid')
        // ->groupBy('fullname')
        // ->select(array('fullname', DB::raw('max(interview.ctualinterviewtime) as interviewtime'), DB::raw('count(fullname) as count'), DB::raw('status as statuscandidate'), DB::raw('max(interview.interviewid) as interviewid')))
        // ->paginate(3);

// dd(DB::getQueryLog());
        $status = DB::table('status')->get();
//         $candidatelistschedule = DB::table('interview')
//        ->join('status', 'status.id', '=', 'interview.statusid')
//        ->join('schedule', 'schedule.scheduleid', '=', 'interview.interviewid')
//        ->join('candidatelist', 'candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
//        ->paginate(10)->groupBy('candidatelistid')->select('candidatelistid', DB::schedule('count(*) as total'));
//     //    ->select('browser', DB::raw('count(*) as total'))
// dd($candidatelistschedule);
//        $jmlcandidatelistschedule = DB::table('interview')->join('schedule', 'schedule.scheduleid', '=', 'interview.interviewid')->count('candidatelistid');
       return view('candidatelistschedule',compact('candidatelistschedule','status'));
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
     * @param  \App\CandidateListSchedule  $candidateListSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateListSchedule $candidateListSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CandidateListSchedule  $candidateListSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidateListSchedule $candidateListSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CandidateListSchedule  $candidateListSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidateListSchedule $candidateListSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CandidateListSchedule  $candidateListSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CandidateListSchedule $candidateListSchedule)
    {
        //
    }

    public function cari(Request $request)
	{
        $cari=$request->cari;		
        $candidatelistschedule = DB::table('candidatelist')
        ->where('fullname','like',"%".$cari."%")
        ->join('schedule', 'schedule.candidatelistid', '=', 'candidatelist.candidatelistid')
        ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
        ->join('status', 'status.id', '=', 'interview.statusid')
        ->groupBy('fullname')
        ->select(array('fullname', DB::raw('max(ctualinterviewtime) as interviewtime'), DB::raw('count(fullname) as count'), DB::raw('status as statuscandidate where max(interview.interviewid)'), DB::raw('interviewid as interviewid')))
        ->paginate(3);
        
        $status = DB::table('status')->get();
        return view('candidatelistschedule',compact('candidatelistschedule','status'));    
    }

    public function history(Request $request)
    {   
        $id = DB::table('schedule')->where('scheduleid',$request->interviewid)->first();

        $link = DB::table('candidatelink')
        ->where('candidatelistid',$id->candidatelistid)
        ->first();

        $candidatelist = DB::table('candidatelist')
        ->where('candidatelistid',$link->candidatelistid)->first();
        
        $candidatelistschedule = DB::table('schedule')
        ->where('candidatelistid',$id->candidatelistid)
        ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
        ->join('status', 'status.id', '=', 'interview.statusid')
    //    ->join('candidatelist', 'candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
       ->join('users', 'users.id', '=', 'interview.id')
       ->get();
    //    dd($candidatelistschedule);
       return view('history',compact('candidatelistschedule','link', 'candidatelist'));
    }
}
