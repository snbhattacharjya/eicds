<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregnancyDeliveryRecord extends Model
{
    protected $table = 'pregnancy_delivery_records';

    public function member(){
      return $this->belongsTo('App\Member','id');
    }
    public function medicalProcedures(){
      return $this->hasMany('App\PregnancyMedicalProcedure','pregnancy_id');
    }
    public function anteNatalCheckups(){
      return $this->hasMany('App\PregnancyAntenatalCheckup','pregnancy_id');
    }
    public function newBorns(){
      return $this->hasMany('App\NewBornDetail','pregnancy_id');
    }
}
