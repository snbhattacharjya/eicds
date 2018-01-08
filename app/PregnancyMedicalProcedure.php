<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregnancyMedicalProcedure extends Model
{
    protected $table = "pregnancy_medical_procedures";

    public function pregnancyRecord(){
      return $this->belongsTo('App\PregnancyDeliveryRecord','id');
    }

    public function procedure(){
      return $this->belongsTo('App\MedicalProcedure','id');
    }
}
