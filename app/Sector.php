<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = "sectors";

    public function project(){
      return $this->belongsTo('App\IcdsProject');
    }

    public function centres(){
      return $this->hasMany('App\AnganwadiCentre');
    }
}
