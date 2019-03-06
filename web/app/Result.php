<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $fillable = [
        'user_id',
        'competition',
        'score'
    ];
    public function User(){
        $this->hasMany('App\User');
    }
}

