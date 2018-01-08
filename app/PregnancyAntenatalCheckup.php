<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregnancyAntenatalCheckup extends Model
{
    protected $table = 'pregnancy_antenatal_checkups';

    public function pregnancyRecord(){
      return $this->belongsTo('App\PregnancyDeliveryRecord','id');
    }
}
