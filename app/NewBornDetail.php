<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBornDetail extends Model
{
    protected $table = 'new_born_details';

    public function member(){
      return $this->belongsTo('App\Member','child_id','id');
    }
    public function pregnancyDeliveryRecord(){
      return $this->belongsTo('App\PregnancyDeliveryRecord','id');
    }
}
