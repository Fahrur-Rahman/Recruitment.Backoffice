<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // 
    protected $table = 'schedule';
    protected $fillable = ['positionid','candidatelistid','isreschedule','reasonreschedule','scheduledate'];
    protected $primaryKey = 'scheduleid';
    public $timestamps = false;

    public function candidatelist()
    {
        return $this->hasMany('App\CandidateList','candidatelistid');
    }

    public function scheduletoposition()
    {
        return $this->hasOne('App\Position','positionid');
    }

    public function scheduleinterview()
    {
        return $this->hasOne('App\Interview','interviewid');
    }
}
