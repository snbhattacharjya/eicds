<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisabilityType extends Model
{
    protected $table = "disability_types";

    protected $fillable = ['disability_type_name'];
}
