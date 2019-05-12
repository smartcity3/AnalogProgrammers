<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class route extends Model
{
    public function bins()
    {
        return $this->hasMany('App\bin');
    }
}
