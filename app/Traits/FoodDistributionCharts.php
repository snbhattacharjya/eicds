<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\SupplementaryFoodDistribution;
use App\User;
use Charts;

trait FoodDistributionCharts{

    public function centralMonthlyProgress(){

      $monthly_progress = Charts::database(SupplementaryFoodDistribution::all(), 'bar', 'highcharts')
      ->title('Food Distribution Monthly')
    ->elementLabel("Total")
    ->dimensions(1000, 500)
    ->responsive(false)
    ->dateColumn('ration_given_date')
    ->groupByDay();
      return $monthly_progress;
    }

}
