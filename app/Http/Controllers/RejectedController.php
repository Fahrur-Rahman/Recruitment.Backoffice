<?php

namespace App\Http\Controllers;

use App\Rejected;
use App\Interview;
use Illuminate\Http\Request;

class RejectedController extends Controller
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
        $validatedData = $request->validate([
            'notattendreason' => 'required|nullable',
        ]);

        $rejected = new Rejected;
        $rejected->rejectreasonid  = $request->noattsi;    
        $rejected->reason = $request->notattendreason;    
        $rejected->save();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rejected  $Rejected
     * @return \Illuminate\Http\Response
     */
    public function show(Rejected $Rejected)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rejected  $Rejected
     * @return \Illuminate\Http\Response
     */
    public function edit(Rejected $Rejected)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rejected  $Rejected
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rejected $Rejected)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rejected  $rejected
     * @return \Illuminate\Http\Response
     */
    public function destroy(rejected $rejected)
    {
        //
    }
}
