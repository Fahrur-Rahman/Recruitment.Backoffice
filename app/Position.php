<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $table = 'position';
    protected $fillable = ['positionname','isactive'];
    protected $primaryKey = 'positionid';
    public $timestamps = false;

    public function positiontoschedule()
    {
        return $this->hasOne('App\Schedule','positionid');
    }
}
