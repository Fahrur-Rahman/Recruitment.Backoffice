<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateListSchedule extends Model
{
    //
    protected $candidatelistschedule = 'interview';
    protected $fillable = ['interviewid','statusid','id','ctualinterviewtime','interviewnote', 'pesonalcandidatestestimony'];
    protected $primaryKey = 'interviewid ';
    public $timestamps = false;

    public function statusinterview()    
    {
     return $this->belongsTo('App\Position','statusid');
    }

    public function interview()
    {
        return $this->hasOneThrough(
            'App\Schedule',
            'App\CandidateList',
            'candidatelistid', 
            'candidatelistid',
            'interviewid',
            'scheduleid'
        );
    }

    public function interviewer()    
    {
     return $this->belongsTo('App\User','id');
    }

}
