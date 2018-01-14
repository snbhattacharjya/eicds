<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaUser extends Model
{
    protected $table = 'area_user';

    public function user(){
      return $this->belongsTo('App\User');
    }
}
