<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LinkController extends Controller
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
        $candidatelink = new Link;
        $candidatelink->candidatelistid = $request->candidatelistid;
        $candidatelink->candidateid = $request->candidate;
        $candidatelink->save();

        $schedulecandidateinterview = DB::table('schedule')->where('candidatelistid', '=', $request->candidatelistid)->first();
        $candidateinformation = DB::table('candidatelist')->where('candidatelistid', '=', $schedulecandidateinterview->candidatelistid)->first();
        $canid = DB::table('candidatelink')->where('candidatelistid', '=', $schedulecandidateinterview->candidatelistid)->first();
        return view ('interview', compact('schedulecandidateinterview','candidateinformation','canid'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }

    public function getcandidatelist($candidateid) 
    {        
        $states = DB::table("candidate")->where("candidateid",$candidateid)->first();
        return json_encode($states);
    }
}
