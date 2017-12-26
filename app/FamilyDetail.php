<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    public function members(){
      return $this->hasMany('App\Member','family_id');
    }

    public function category(){
      return $this->belongsTo('App\Category');
    }
}
