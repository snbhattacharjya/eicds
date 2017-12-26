<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function family(){
      return $this->belongsTo('App\FamilyDetail');
    }
}
