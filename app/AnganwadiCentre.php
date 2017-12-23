<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnganwadiCentre extends Model
{
    protected $table = "anganwadi_centres";

    public function sector(){
      return $this->belongsTo('App\Sector');
    }
}
