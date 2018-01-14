<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = DB::table('icds_projects')->where([
          ['district_id', '=', Auth::user()->area->area_id],
        ])->get();

        $targets = DB::table('target_types')->whereNotIn('id', [4,5])->get();

        $categories = DB::table('categories')->get();

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
              ['icds_projects.district_id', '=', Auth::user()->area->area_id],
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


        $chart = Charts::multi('bar', 'highcharts')
            ->title('Target Distribution in Projects')
            ->colors(['#ff0000', '#00ff00', '#0000ff'])
            ->labels($projects->pluck('project_name')->toArray());
        foreach ($datasets as $dataset) {
          $chart->dataset($dataset['label'], $dataset['values']->toArray());

        }


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
              ['icds_projects.district_id', '=', Auth::user()->area->area_id],
            ])
            ->whereNotIn('members.target_id',[4,5])
            ->groupBy('categories.category_name')
            ->get();


        $pie_chart = Charts::create('pie', 'highcharts')
            ->title('Category Distribution in Projects')
            ->colors(['#b0f0fb', '#0fff00', '#000fff'])
            ->labels($categories->pluck('category_name')->toArray())
            ->values($chart_data->pluck('count')->toArray());

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
                  ['icds_projects.district_id', '=', Auth::user()->area->area_id],
                ])
                ->groupBy('members.gender')
                ->get();


            $donut_chart = Charts::create('donut', 'highcharts')
                ->title('Child Gender Ratio Projects')
                ->labels(['Male','Female'])
                ->values($chart_data->pluck('count')->toArray());


        $type = strtolower(Auth::user()->type);
        return view('dashboard.'.$type,['chart' => $chart, 'pie_chart' => $pie_chart, 'donut_chart' => $donut_chart]);
    }
}
