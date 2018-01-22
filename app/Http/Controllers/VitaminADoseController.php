<?php

namespace App\Http\Controllers;

use App\VitaminADose;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VitaminADoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->type == 'Central'){
        $central_doses = $this->getCentralDoses();
        $state_doses = $this->getAllStateDoses();
        $district_doses = $this->getAllDistrictDoses();

        $doses = array_merge($central_doses,$state_doses,$district_doses);
        $doses = collect($doses);
      }
      else if(Auth::user()->type == 'State'){
        $central_doses = $this->getCentralDoses();
        $state_doses = $this->getOnlyStateDoses(Auth::user()->area->area_id);

        $doses = array_merge($central_doses,$state_doses);
        $doses = collect($doses);
      }
      else {
        $central_doses = $this->getCentralDoses();
        $district_doses = $this->getOnlyDistrictDoses(Auth::user()->area->area_id);

        $doses = array_merge($central_doses,$district_doses);
        $doses = collect($doses);
      }

      return view('vitaminadose.index',['doses' => $doses]);
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
        'dose_name' => 'required|string|max:255',
        'due_month_from_birth' => 'required|numeric',
      ]);

      $dose = new VitaminADose;
      $dose->dose_name = $request->dose_name;
      if(Auth::user()->type == 'Central'){
        $dose->type = 'Central';
      }
      else{
        $dose->type = Auth::user()->type;
        $dose->area_id = Auth::user()->area->area_id;
      }
      $dose->due_month_from_birth = $request->due_month_from_birth;

      $dose->save();
      Session::flash('success','New Vitamin A Dose Added Successfully with ID:'.$dose->id);
      return redirect()->route('vitaminadose.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VitaminADose  $vitaminADose
     * @return \Illuminate\Http\Response
     */
    public function show(VitaminADose $vitaminADose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VitaminADose  $vitaminADose
     * @return \Illuminate\Http\Response
     */
    public function edit(VitaminADose $vitaminADose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VitaminADose  $vitaminADose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VitaminADose $vitaminADose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VitaminADose  $vitaminADose
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitaminADose $vitaminADose)
    {
        //
    }

    public function getCentralDoses(){
      return VitaminADose::where('type', 'Central')->get()->toArray();
    }

    public function getAllStateDoses(){
      $doses = VitaminADose::where('type', 'State')->get();
      $state_doses = array();
      foreach ($doses as $dose) {
        $area = DB::table('states')->where('id',$dose->area_id)->first();
        $state_doses[] = array_merge($dose->toArray(),['supported_by' => $area->state_name]);
      }
      return $state_doses;
    }

    public function getAllDistrictDoses(){
      $doses = VitaminADose::where('type', 'District')->get();
      $district_doses = array();
      foreach ($doses as $dose) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$dose->area_id)->first();
        $district_doses[] = array_merge($dose->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }
      return $district_doses;
    }

    public function getOnlyStateDoses(int $state_id){
      $doses = VitaminADose::where([
                      ['type','=','State'],
                      ['area_id','=',$state_id],
                    ])->get();
      $state_doses = array();
      foreach ($doses as $dose) {
        $area = DB::table('states')->where('id',$dose->area_id)->first();
        $state_doses[] = array_merge($dose->toArray(),['supported_by' => $area->state_name]);
      }

      $doses = DB::table('vitamin_a_doses')
                    ->join('districts','vitamin_a_doses.area_id','=','districts.id')
                    ->join('states','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','District'],
                        ['states.id','=',$state_id],
                      ])
                    ->select('vitamin_a_doses.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($doses as $dose) {
        $state_doses[] = array('id' => $dose->id, 'dose_name' => $dose->dose_name, 'due_month_from_birth' => $dose->due_month_from_birth, 'type' => $dose->type, 'supported_by' => $dose->district_name.', '.$dose->state_name);
      }
      return $state_doses;
    }

    public function getOnlyDistrictDoses(int $district_id){
      $district_doses = array();
      //Get State Doses for the district
      $doses = DB::table('vitamin_a_doses')
                    ->join('states','vitamin_a_doses.area_id','=','states.id')
                    ->join('districts','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','State'],
                        ['districts.id','=',$district_id],
                      ])
                    ->select('vitamin_a_doses.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($doses as $dose) {
        $district_doses[] = array('id' => $dose->id, 'dose_name' => $dose->dose_name, 'due_month_from_birth' => $dose->due_month_from_birth, 'type' => $dose->type, 'supported_by' => $dose->state_name);
      }
      //Get District Specific Doses
      $doses = VitaminADose::where([
                      ['type','=','District'],
                      ['area_id','=',$district_id],
                    ])->get();

      foreach ($doses as $dose) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$dose->area_id)->first();
        $district_doses[] = array_merge($dose->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }

      return $district_doses;
    }
}
