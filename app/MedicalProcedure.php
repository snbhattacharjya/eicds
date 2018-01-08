<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalProcedure extends Model
{
    protected $table = 'medical_procedures';

    public function pregnancyProcedures(){
      return $this->hasMany('App\PregnancyMedicalProcedure','procedure_id');
    }
}
