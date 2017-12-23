<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcdsProject extends Model
{
    protected $table = "icds_projects";

    public function district(){
      return $this->belongsTo('App\District');
    }

    public function sectors(){
      return $this->hasMany('App\Sector');
    }
}
