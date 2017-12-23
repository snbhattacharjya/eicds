<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";

    public function districts(){
      return $this->hasMany('App\District','state_id');
    }
}
