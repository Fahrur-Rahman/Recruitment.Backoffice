<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    protected $table = 'rejectedreason';
    protected $fillable = ['rejectreasonid','reason'];
    protected $primaryKey = 'rejectreasonid';
    public $incrementing = false;
    public $timestamps = false;
    
}