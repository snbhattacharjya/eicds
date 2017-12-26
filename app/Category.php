<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['category_code','category_name'];

    public function families(){
      return $this->hasMany('App\FamilyDetail','category_id');
    }
}
