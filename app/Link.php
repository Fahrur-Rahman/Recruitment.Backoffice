<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "candidatelink";
    protected $fillable = ['candidatelistid','candidateid'];
    protected $primaryKey = 'candidatelistid';
    public $incrementing = false;
    public $timestamps = false;
    public function candidate()    
    {
    return $this->hasMany('App\Candidate', 'candidateid');
    }
    public function candidatelist()    
    {
    return $this->hasMany('App\Candidatelist', 'candidatelistid');
    }
}
