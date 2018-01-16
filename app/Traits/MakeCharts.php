<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use Charts;

trait MakeCharts{

    public function districtPopulationBar($district_id){

      $projects = DB::table('icds_projects')->where([
        ['district_id', '=', $district_id],
      ])->get();

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('icds_projects.project_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['districts.id', '=', $district_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('icds_projects.project_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels($projects->pluck('project_name')->toArray());
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }


    public function districtCategoryPie($district_id){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['districts.id', '=', $district_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }


    public function districtGenderDonut($district_id){

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
            ['districts.id', '=', $district_id],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }

    public function projectPopulationBar($project_id){

      $centres = DB::table('anganwadi_centres')
        ->join('sectors', 'anganwadi_centres.sector_id', '=', 'sectors.id')
        ->where([
            ['sectors.project_id', '=', $project_id],
          ])
        ->select('anganwadi_centres.*')
        ->get();

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('anganwadi_centres.centre_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['icds_projects.id', '=', $project_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('anganwadi_centres.centre_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels($centres->pluck('centre_name')->toArray());
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }
    public function projectCategoryPie($project_id){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['icds_projects.id', '=', $project_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }

    public function projectGenderDonut($project_id){

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
            ['icds_projects.id', '=', $project_id],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }

    public function sectorPopulationBar($sector_id){

      $centres = DB::table('anganwadi_centres')->where([
            ['sector_id', '=', $sector_id],
          ])->get();

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('anganwadi_centres.centre_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['sectors.id', '=', $sector_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('anganwadi_centres.centre_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels($centres->pluck('centre_name')->toArray());
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }

    public function sectorCategoryPie($sector_id){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['sectors.id', '=', $sector_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }

    public function sectorGenderDonut($sector_id){

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
            ['sectors.id', '=', $sector_id],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }

    public function centrePopulationBar($centre_id){

      $centres = DB::table('anganwadi_centres')->where([
            ['id', '=', $centre_id],
          ])->get();

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('anganwadi_centres.centre_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['anganwadi_centres.id', '=', $centre_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('anganwadi_centres.centre_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels($centres->pluck('centre_name')->toArray());
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }

    public function centreCategoryPie($centre_id){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['anganwadi_centres.id', '=', $centre_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }

    public function centreGenderDonut($centre_id){

      $chart_data = DB::table('districts')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
            ['anganwadi_centres.id', '=', $centre_id],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }

    public function statePopulationBar($state_id){

      /*$centres = DB::table('anganwadi_centres')->where([
            ['id', '=', $state_id],
          ])->get();*/

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('districts.district_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['districts.state_id', '=', $state_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('districts.district_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels(array_unique($chart_data->pluck('district_name')->toArray()));
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }

    public function stateCategoryPie($state_id){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['districts.state_id', '=', $state_id],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }

    public function stateGenderDonut($state_id){

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
            ['districts.state_id', '=', $state_id],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }

    public function centralPopulationBar(){

      /*$centres = DB::table('anganwadi_centres')->where([
            ['id', '=', $state_id],
          ])->get();*/

      $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('states.state_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('states.state_name', 'target_types.target_name')
          ->get();
      $datasets = collect([]);

      foreach ($targets as $target) {
        $datasets->push(['label' => $target->target_name, 'values' => $chart_data->filter(function($item) use ($target){
          return $item->target_name == $target->target_name ? $item->count : 0;
        })->pluck('count')]);
      }


      $population_chart = Charts::multi('bar', 'highcharts')
          ->title('Target Distribution in Projects')
          ->colors(['#ff0000', '#00ff00', '#0000ff'])
          ->labels(array_unique($chart_data->pluck('state_name')->toArray()));
      foreach ($datasets as $dataset) {
        $population_chart->dataset($dataset['label'], $dataset['values']->toArray());

      }

      return $population_chart;
    }

    public function centralCategoryPie(){

      $categories = DB::table('categories')->get();

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('family_details','members.family_id', '=', 'family_details.id')
          ->join('categories', 'family_details.category_id', '=', 'categories.id')
          ->select('categories.category_name')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
          ])
          ->whereNotIn('members.target_id',[4,5])
          ->groupBy('categories.category_name')
          ->get();


      $category_chart = Charts::create('pie', 'highcharts')
          ->title('Category Distribution in Projects')
          ->colors(['#b0f0fb', '#0fff00', '#000fff'])
          ->labels($categories->pluck('category_name')->toArray())
          ->values($chart_data->pluck('count')->toArray());

      return $category_chart;
    }

    public function centralGenderDonut(){

      $chart_data = DB::table('states')
          ->join('districts', 'states.id', '=', 'districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->select('members.gender')
          ->selectRaw('COUNT(*) as count')
          ->where([
            ['members.active_status', '=', 1],
            ['members.target_id', '=', 3],
          ])
          ->groupBy('members.gender')
          ->get();


      $gender_chart = Charts::create('donut', 'highcharts')
          ->title('Child Gender Ratio Projects')
          ->labels(['Male','Female'])
          ->values($chart_data->pluck('count')->toArray());

      return $gender_chart;
    }
}
