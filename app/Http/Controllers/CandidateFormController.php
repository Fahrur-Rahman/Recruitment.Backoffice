<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\CandidateForm;
use Illuminate\Http\Request;

class CandidateFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidateform = CandidateForm::paginate(3);

        return view('candidateform', compact('candidateform'));
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
     * @param  \App\CandidateForm  $candidateForm
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateForm $candidateForm)
    {
        return $candidateForm;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CandidateForm  $candidateForm
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidateForm $candidateForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CandidateForm  $candidateForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidateForm $candidateForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CandidateForm  $candidateForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(CandidateForm $candidateForm)
    {
        //
    }

    public function cari(Request $request)
	{
		$cari = $request->cari;
 
		$candidateform = DB::table('candidate')
		->where('fullname','like',"%".$cari."%")
		->paginate(3);

		return view('candidateform', compact('candidateform'));
	}
}
