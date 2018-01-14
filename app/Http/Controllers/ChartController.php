<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function areaTargets(){
      
    }

    public function areaCategories(){

    }

    public function areaChildRatio(){

    }

}
