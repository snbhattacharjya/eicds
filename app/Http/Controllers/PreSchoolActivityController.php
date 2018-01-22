<?php

namespace App\Http\Controllers;

use App\PreSchoolActivity;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreSchoolActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->type == 'Central'){
        $central_activities = $this->getCentralActivities();
        $state_activities = $this->getAllStateActivities();
        $district_activities = $this->getAllDistrictActivities();

        $activities = array_merge($central_activities,$state_activities,$district_activities);
        $activities = collect($activities);
      }
      else if(Auth::user()->type == 'State'){
        $central_activities = $this->getCentralActivities();
        $state_activities = $this->getOnlyStateActivities(Auth::user()->area->area_id);

        $activities = array_merge($central_activities,$state_activities);
        $activities = collect($activities);
      }
      else {
        $central_activities = $this->getCentralActivities();
        $district_activities = $this->getOnlyDistrictActivities(Auth::user()->area->area_id);

        $activities = array_merge($central_activities,$district_activities);
        $activities = collect($activities);
      }

      return view('preschoolactivity.index',['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'activity_name' => 'required|string|max:255',
        ]);
        $activity = new PreSchoolActivity;
        $activity->activity_name = $request->activity_name;
        if(Auth::user()->type == 'Central'){
          $activity->type = 'Central';
        }
        else{
          $activity->type = Auth::user()->type;
          $activity->area_id = Auth::user()->area->area_id;
        }
        $activity->save();

        Session::flash('success', 'New PreSchool Activity Added Successfully with ID: '.$activity->id);
        return redirect()->route('preschoolactivity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function show(PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    public function getCentralActivities(){
      return PreSchoolActivity::where('type', 'Central')->get()->toArray();
    }

    public function getAllStateActivities(){
      $activities = PreSchoolActivity::where('type', 'State')->get();
      $state_activities = array();
      foreach ($activities as $activity) {
        $area = DB::table('states')->where('id',$activity->area_id)->first();
        $state_activities[] = array_merge($activity->toArray(),['supported_by' => $area->state_name]);
      }
      return $state_activities;
    }

    public function getAllDistrictActivities(){
      $activities = PreSchoolActivity::where('type', 'District')->get();
      $district_activities = array();
      foreach ($activities as $activity) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$activity->area_id)->first();
        $district_activities[] = array_merge($activity->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }
      return $district_activities;
    }

    public function getOnlyStateActivities(int $state_id){
      $activities = PreSchoolActivity::where([
                      ['type','=','State'],
                      ['area_id','=',$state_id],
                    ])->get();
      $state_activities = array();
      foreach ($activities as $activity) {
        $area = DB::table('states')->where('id',$activity->area_id)->first();
        $state_activities[] = array_merge($activity->toArray(),['supported_by' => $area->state_name]);
      }

      $activities = DB::table('pre_school_activities')
                    ->join('districts','pre_school_activities.area_id','=','districts.id')
                    ->join('states','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','District'],
                        ['states.id','=',$state_id],
                      ])
                    ->select('pre_school_activities.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($activities as $activity) {
        $state_activities[] = array('id' => $activity->id, 'activity_name' => $activity->activity_name, 'type' => $activity->type, 'supported_by' => $activity->district_name.', '.$activity->state_name);
      }
      return $state_activities;
    }

    public function getOnlyDistrictActivities(int $district_id){
      $district_activities = array();
      //Get State Activities for the district
      $activities = DB::table('pre_school_activities')
                    ->join('states','pre_school_activities.area_id','=','states.id')
                    ->join('districts','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','State'],
                        ['districts.id','=',$district_id],
                      ])
                    ->select('pre_school_activities.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($activities as $activity) {
        $district_activities[] = array('id' => $activity->id, 'activity_name' => $activity->activity_name, 'type' => $activity->type, 'supported_by' => $activity->state_name);
      }
      //Get District Specific Activities
      $activities = PreSchoolActivity::where([
                      ['type','=','District'],
                      ['area_id','=',$district_id],
                    ])->get();

      foreach ($activities as $activity) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$activity->area_id)->first();
        $district_activities[] = array_merge($activity->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }

      return $district_activities;
    }
}
