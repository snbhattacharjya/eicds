<?php

namespace App\Http\Controllers;

use App\MedicalProcedure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->type == 'Central'){
        $central_procedures = $this->getCentralProcedures();
        $state_procedures = $this->getAllStateProcedures();
        $district_procedures = $this->getAllDistrictProcedures();

        $procedures = array_merge($central_procedures,$state_procedures,$district_procedures);
        $procedures = collect($procedures);
      }
      else if(Auth::user()->type == 'State'){
        $central_procedures = $this->getCentralProcedures();
        $state_procedures = $this->getOnlyStateProcedures(Auth::user()->area->area_id);

        $procedures = array_merge($central_procedures,$state_procedures);
        $procedures = collect($procedures);
      }
      else {
        $central_procedures = $this->getCentralProcedures();
        $district_procedures = $this->getOnlyDistrictProcedures(Auth::user()->area->area_id);

        $procedures = array_merge($central_procedures,$district_procedures);
        $procedures = collect($procedures);
      }

      return view('medicalprocedure.index',['procedures' => $procedures]);
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
        'procedure_name' => 'required|string|max:255',
      ]);
      $procedure = new MedicalProcedure;
      $procedure->procedure_name = $request->procedure_name;
      if(Auth::user()->type == 'Central'){
        $procedure->type = 'Central';
      }
      else{
        $procedure->type = Auth::user()->type;
        $procedure->area_id = Auth::user()->area->area_id;
      }
      $procedure->save();

      Session::flash('success', 'New Medical Procedure Added Successfully with ID: '.$procedure->id);
      return redirect()->route('medicalprocedure.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicalProcedure  $medicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalProcedure $medicalProcedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicalProcedure  $medicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalProcedure $medicalProcedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicalProcedure  $medicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalProcedure $medicalProcedure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicalProcedure  $medicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalProcedure $medicalProcedure)
    {
        //
    }

    public function getCentralProcedures(){
      return MedicalProcedure::where('type', 'Central')->get()->toArray();
    }

    public function getAllStateProcedures(){
      $procedures = MedicalProcedure::where('type', 'State')->get();
      $state_procedures = array();
      foreach ($procedures as $procedure) {
        $area = DB::table('states')->where('id',$procedure->area_id)->first();
        $state_procedures[] = array_merge($procedure->toArray(),['supported_by' => $area->state_name]);
      }
      return $state_procedures;
    }

    public function getAllDistrictProcedures(){
      $procedures = MedicalProcedure::where('type', 'District')->get();
      $district_procedures = array();
      foreach ($procedures as $procedure) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$procedure->area_id)->first();
        $district_procedures[] = array_merge($procedure->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }
      return $district_procedures;
    }

    public function getOnlyStateProcedures(int $state_id){
      $procedures = MedicalProcedure::where([
                      ['type','=','State'],
                      ['area_id','=',$state_id],
                    ])->get();
      $state_procedures = array();
      foreach ($procedures as $procedure) {
        $area = DB::table('states')->where('id',$procedure->area_id)->first();
        $state_procedures[] = array_merge($procedure->toArray(),['supported_by' => $area->state_name]);
      }

      $procedures = DB::table('medical_procedures')
                    ->join('districts','medical_procedures.area_id','=','districts.id')
                    ->join('states','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','District'],
                        ['states.id','=',$state_id],
                      ])
                    ->select('medical_procedures.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($procedures as $procedure) {
        $state_procedures[] = array('id' => $procedure->id, 'procedure_name' => $procedure->procedure_name, 'type' => $procedure->type, 'supported_by' => $procedure->district_name.', '.$procedure->state_name);
      }
      return $state_procedures;
    }

    public function getOnlyDistrictProcedures(int $district_id){
      $district_procedures = array();
      //Get State Procedures for the district
      $procedures = DB::table('medical_procedures')
                    ->join('states','medical_procedures.area_id','=','states.id')
                    ->join('districts','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','State'],
                        ['districts.id','=',$district_id],
                      ])
                    ->select('medical_procedures.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($procedures as $procedure) {
        $district_procedures[] = array('id' => $procedure->id, 'procedure_name' => $procedure->procedure_name, 'type' => $procedure->type, 'supported_by' => $procedure->state_name);
      }
      //Get District Specific Procedures
      $procedures = MedicalProcedure::where([
                      ['type','=','District'],
                      ['area_id','=',$district_id],
                    ])->get();

      foreach ($procedures as $procedure) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$procedure->area_id)->first();
        $district_procedures[] = array_merge($procedure->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }

      return $district_procedures;
    }
}
