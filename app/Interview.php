<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //
    protected $table = "interview";
    protected $fillable = ['interviewid','statusid','interviewer','ctualinterviewtime','interviewnote','pesonalcandidatestestimony'];
    protected $primaryKey = 'interviewid';
    public $timestamps = false;
    public function interviewer()  {
    return $this->hasOne('App\User');
    }
    public function interviewposition()
    {
    return $this->hasOne('App\Position','positionid');
    }
    public function interviewdate()
    {
    return $this->hasOne('App\Schedule','positionid');
    }
}
