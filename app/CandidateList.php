<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateList extends Model
{
    //
    protected $table = 'candidatelist';
    protected $fillable = ['fullname','email','mobilephone','niknumber','notecandidate'];
    protected $primaryKey = 'candidatelistid';
    public $timestamps = false;

    public function schedule()    
    {
     return $this->belongsTo('App\Schedule','candidatelistid');
    }

    public function link()    
    {
     return $this->belongsTo('App\Link','candidatelistid');
    }
}
