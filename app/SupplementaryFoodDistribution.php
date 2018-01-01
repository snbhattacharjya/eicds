<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupplementaryFoodDistribution extends Model
{
    protected $table = "supplementary_food_distributions";

    public function saveFoodType(int $food_type){
      DB::table('supplementary_distribution_food_types')->insert(
        ['distribution_id' => $this->id, 'food_type_id' => $food_type]
      );
      return;
    }
}
