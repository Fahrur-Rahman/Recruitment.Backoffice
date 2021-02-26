<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $history = "candidatelink";
    protected $fillable = ['candidatelistid','candidateid'];
    protected $primaryKey = 'candidatelistid';
    public $timestamps = false;

    public function candidate()    
    {
    return $this->hasOne('App\User');
    }

    public function interview()
    {
        return $this->hasOneThrough(
            'App\Interview',
            'App\Schedule',
            'scheduleid', 
            'interviewid',
            'candidatelistid',
            'candidatelistid'
        );
    }
}
