<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function family(){
      return $this->belongsTo('App\FamilyDetail');
    }

    public function target(){
      return $this->belongsTo('App\TargetType');
    }

    public function disability(){
      return $this->belongsTo('App\DisabilityType');
    }

    public function pregnancyDeliveryRecords(){
      return $this->hasMany('App\PregnancyDeliveryRecord','member_id');
    }

    public function newBorn(){
      return $this->hasOne('App\NewBornDetail','child_id');
    }
}
