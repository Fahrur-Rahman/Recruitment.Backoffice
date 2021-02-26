<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewClient extends Model
{
    protected $table = "interviewbyclient";
    protected $fillable = ['interviewid','interviewbyclientdescription','statusclientid','interviewername','interviewjobposition','company'];
    protected $primaryKey = 'interviewid';
    public $timestamps = false;
}
