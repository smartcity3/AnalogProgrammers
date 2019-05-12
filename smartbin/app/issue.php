<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    public $timestamps = true;

    public function bin() 
    {
        return $this->belongsTo('bin');
    }
}
