<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bin extends Model
{
    public function route() 
    {
        return $this->belongsTo('App\route');
    }
    public function issue()
    {
        return $this->hasMany('App\issue');
    }
}
