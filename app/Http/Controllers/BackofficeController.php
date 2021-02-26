<?php

namespace App\Http\Controllers;
use Auth;
use App\Traits\Excludable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Interview;
use App\CandidateList;
use App\Candidate;
use App\Position;
use App\Schedule;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function login()
    {
        return view('loginbackoffice');
    }

    public function postloginbackoffice(Request $request)
    {
        // dd($request);
        if(Auth::attempt($request->only('name','password'))){
            return redirect('/dashboardbackoffice');
        }
        return redirect('/loginbackoffice');
    }

    public function berhasil()
    {
        $candidate = DB::table('interview')
        ->join('schedule','schedule.scheduleid', '=', 'interview.interviewid')
        ->join('candidatelist','candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
        ->join('candidatelink','candidatelink.candidatelistid', '=', 'candidatelist.candidatelistid')
        ->join('candidate','candidate.candidateid', '=', 'candidatelink.candidateid')
        ->leftjoin(DB::raw("(SELECT `jml`, CASE WHEN `statusid` = 5 THEN `interviewbyclient`.`statusclientid` ELSE `interview`.`statusid` END AS `anotherstatus` FROM `interview` INNER JOIN `interviewbyclient` ON `interviewbyclient`.`interviewid` = `interview`.`interviewid` INNER JOIN (SELECT MAX(`interviewid`) as `jml` FROM `interview` INNER JOIN `schedule` on `schedule`.`scheduleid` = `interview`.`interviewid` GROUP BY `schedule`.`candidatelistid`) AS `t1` ON `t1`.`jml` = `interview`.`interviewid`) as t2"),function($join){
            $join->on("interview.interviewid", "=", "t2.jml");
        })
        ->orderBy('interviewid', 'DESC')->take(6)->get();
        
        $maxfirstdate = DB::table('candidatelist')
        ->join('schedule','schedule.candidatelistid', '=', 'candidatelist.candidatelistid')
        ->join('interview', 'interview.interviewid', '=', 'schedule.scheduleid')
        ->leftjoin(DB::raw("(SELECT `jml`, CASE WHEN `statusid` = 5 THEN `interviewbyclient`.`statusclientid` ELSE `interview`.`statusid` END AS `anotherstatus` FROM `interview` INNER JOIN `interviewbyclient` ON `interviewbyclient`.`interviewid` = `interview`.`interviewid` INNER JOIN (SELECT MAX(`interviewid`) as `jml` FROM `interview` INNER JOIN `schedule` on `schedule`.`scheduleid` = `interview`.`interviewid` GROUP BY `schedule`.`candidatelistid`) AS `t1` ON `t1`.`jml` = `interview`.`interviewid`) as t2"),function($join){
            $join->on("interview.interviewid", "=", "t2.jml");
        })
        ->select(array('schedule.candidatelistid','fullname', DB::raw('max(interview.ctualinterviewtime) as maxtime'), DB::raw('count(schedule.candidatelistid) as countcandidate'), DB::raw('statusid as statuscandidate'), DB::raw('max(interview.interviewid) as interviewid')))
        ->groupby('fullname')->get();
        $statuspurpose = 0;
        $statusaccpet = 0;
        $statusreject = 0;
        // $maxseconddate = DB::select('SELECT jml, CASE WHEN statusid = 5 THEN interviewbyclient.statusclientid ELSE interview.statusid END AS anotherstatus FROM interview INNER JOIN interviewbyclient ON interviewbyclient.interviewid = interview.interviewid INNER JOIN (SELECT MAX(interviewid) as jml FROM interview INNER JOIN schedule on schedule.scheduleid = interview.interviewid GROUP BY schedule.candidatelistid) AS t1 ON t1.jml = interview.interviewid');
        foreach ($maxfirstdate as $first) {
            if ($first->statuscandidate == 1) {
                    $statuspurpose = $statuspurpose + 1;}
                elseif($first->statuscandidate == 2){
                    $statusaccpet = $statusaccpet + 1;
            }
            else{
                $statusreject = $statusreject + 1;
            }
        }
        $jmlcandidate = schedule::count();
        return view('dashboardbackoffice', compact('candidate','jmlcandidate','statuspurpose','statusaccpet','statusreject'));
    }
    public function schedule()
    {   
        $table = DB::table('schedule')
        ->join('candidatelist', 'candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
        ->join('position', 'position.positionid', '=', 'schedule.positionid')       
        ->leftJoin('interview','interview.interviewid', '=', 'schedule.scheduleid')
        ->whereNull('interviewid')
        ->paginate(3);
        
        
        $modalcandidatelist = CandidateList::all();

        $posisi = DB::table('position')->get();
       
        return view('schedule', compact('table', 'modalcandidatelist','posisi'));
    }

    public function logoutbackoffice()
    {
        Auth::logout();
        return redirect('/loginbackoffice');
    }

    // public function index()
    // {
    //     $candidate = Candidate::all();
    //     return view('dashboardbackoffice', ['candidate' => $candidate]);
    // }
    public function cari(Request $request)
	{
        $cari=$request->cari;		
        $table = DB::table('candidatelist')
        ->where('fullname','like',"%".$cari."%")
        ->join('schedule', 'candidatelist.candidatelistid', '=', 'schedule.candidatelistid')
        ->join('position', 'position.positionid', '=', 'schedule.positionid')       
        ->paginate(3);
        
        $modalcandidatelist = CandidateList::all();
       
        return view('/schedule', compact('table', 'modalcandidatelist'));
    }
    public function recruitment()
    {
        $recruitment = DB::connection('mysql2')->select('SELECT * FROM candidate');
        return $recruitment;
    }

}
