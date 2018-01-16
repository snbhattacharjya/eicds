<?php

namespace App\Traits;

use App\Traits\MakeCharts;

trait Dashboard{

  use MakeCharts;
  public function getDashboard($type,$area_id){

    $charts = [];
    switch ($type) {
        case 'district':
            $population_chart = $this->districtPopulationBar($area_id);
            $category_chart = $this->districtCategoryPie($area_id);
            $gender_chart = $this->districtGenderDonut($area_id);
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
        case 'project':
            $population_chart = $this->projectPopulationBar($area_id);
            $category_chart = $this->projectCategoryPie($area_id);
            $gender_chart = $this->projectGenderDonut($area_id);
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
        case 'sector':
            $population_chart = $this->sectorPopulationBar($area_id);
            $category_chart = $this->sectorCategoryPie($area_id);
            $gender_chart = $this->sectorGenderDonut($area_id);
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
        case 'center':
            $population_chart = $this->centrePopulationBar($area_id);
            $category_chart = $this->centreCategoryPie($area_id);
            $gender_chart = $this->centreGenderDonut($area_id);
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
        case 'state':
            $population_chart = $this->statePopulationBar($area_id);
            $category_chart = $this->stateCategoryPie($area_id);
            $gender_chart = $this->stateGenderDonut($area_id);
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
        case 'central':
            $population_chart = $this->centralPopulationBar();
            $category_chart = $this->centralCategoryPie();
            $gender_chart = $this->centralGenderDonut();
            $charts = ['population_chart' => $population_chart, 'category_chart' => $category_chart, 'gender_chart' => $gender_chart];
            break;
    }

      return $charts;
  }

}
