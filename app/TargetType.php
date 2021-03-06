<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetType extends Model
{
    protected $table = "target_types";

    protected $fillable = ['target_name_short', 'target_name'];

    public function memmbers(){
      return $this->hasMany('App\Member','target_id');
    }
}
