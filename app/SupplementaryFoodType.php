<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplementaryFoodType extends Model
{
    protected $table = "supplementary_food_types";

    protected $fillable = ['type_name'];
}
