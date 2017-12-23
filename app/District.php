<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts";

    public function state(){
      return $this->belongsTo('App\State');
    }

    public function icdsProjects(){
      return $this->hasMany('App\IcdsProject');
    }
}
