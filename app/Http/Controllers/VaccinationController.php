<?php

namespace App\Http\Controllers;

use App\Vaccination;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->type == 'Central'){
        $central_vaccinations = $this->getCentralVaccinations();
        $state_vaccinations = $this->getAllStateVaccinations();
        $district_vaccinations = $this->getAllDistrictVaccinations();

        $vaccinations = array_merge($central_vaccinations,$state_vaccinations,$district_vaccinations);
        $vaccinations = collect($vaccinations);
      }
      else if(Auth::user()->type == 'State'){
        $central_vaccinations = $this->getCentralVaccinations();
        $state_vaccinations = $this->getOnlyStateVaccinations(Auth::user()->area->area_id);

        $vaccinations = array_merge($central_vaccinations,$state_vaccinations);
        $vaccinations = collect($vaccinations);
      }
      else {
        $central_vaccinations = $this->getCentralVaccinations();
        $district_vaccinations = $this->getOnlyDistrictVaccinations(Auth::user()->area->area_id);

        $vaccinations = array_merge($central_vaccinations,$district_vaccinations);
        $vaccinations = collect($vaccinations);
      }

      return view('vaccination.index',['vaccinations' => $vaccinations]);
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
          'vaccination_name' => 'required|string|max:255',
          'due_month_from_birth' => 'required|numeric',
        ]);

        $vaccination = new Vaccination;
        $vaccination->vaccination_name = $request->vaccination_name;
        if(Auth::user()->type == 'Central'){
          $vaccination->type = 'Central';
        }
        else{
          $vaccination->type = Auth::user()->type;
          $vaccination->area_id = Auth::user()->area->area_id;
        }
        $vaccination->due_month_from_birth = $request->due_month_from_birth;

        $vaccination->save();
        Session::flash('success','New Vaccination Added Successfully with ID:'.$vaccination->id);
        return redirect()->route('vaccination.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccination $vaccination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccination $vaccination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccination $vaccination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccination $vaccination)
    {
        //
    }

    public function getCentralVaccinations(){
      return Vaccination::where('type', 'Central')->get()->toArray();
    }

    public function getAllStateVaccinations(){
      $vaccinations = Vaccination::where('type', 'State')->get();
      $state_vaccinations = array();
      foreach ($vaccinations as $vaccination) {
        $area = DB::table('states')->where('id',$vaccination->area_id)->first();
        $state_vaccinations[] = array_merge($vaccination->toArray(),['supported_by' => $area->state_name]);
      }
      return $state_vaccinations;
    }

    public function getAllDistrictVaccinations(){
      $vaccinations = Vaccination::where('type', 'District')->get();
      $district_vaccinations = array();
      foreach ($vaccinations as $vaccination) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$vaccination->area_id)->first();
        $district_vaccinations[] = array_merge($vaccination->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }
      return $district_vaccinations;
    }

    public function getOnlyStateVaccinations(int $state_id){
      $vaccinations = Vaccination::where([
                      ['type','=','State'],
                      ['area_id','=',$state_id],
                    ])->get();
      $state_vaccinations = array();
      foreach ($vaccinations as $vaccination) {
        $area = DB::table('states')->where('id',$vaccination->area_id)->first();
        $state_vaccinations[] = array_merge($vaccination->toArray(),['supported_by' => $area->state_name]);
      }

      $vaccinations = DB::table('vaccinations')
                    ->join('districts','vaccinations.area_id','=','districts.id')
                    ->join('states','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','District'],
                        ['states.id','=',$state_id],
                      ])
                    ->select('vaccinations.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($vaccinations as $vaccination) {
        $state_vaccinations[] = array('id' => $vaccination->id, 'vaccination_name' => $vaccination->vaccination_name, 'due_month_from_birth' => $vaccination->due_month_from_birth, 'type' => $vaccination->type, 'supported_by' => $vaccination->district_name.', '.$vaccination->state_name);
      }
      return $state_vaccinations;
    }

    public function getOnlyDistrictVaccinations(int $district_id){
      $district_vaccinations = array();
      //Get State Vaccinations for the district
      $vaccinations = DB::table('vaccinations')
                    ->join('states','vaccinations.area_id','=','states.id')
                    ->join('districts','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','State'],
                        ['districts.id','=',$district_id],
                      ])
                    ->select('vaccinations.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($vaccinations as $vaccination) {
        $district_vaccinations[] = array('id' => $vaccination->id, 'vaccination_name' => $vaccination->vaccination_name, 'due_month_from_birth' => $vaccination->due_month_from_birth, 'type' => $vaccination->type, 'supported_by' => $vaccination->state_name);
      }
      //Get District Specific Vaccinations
      $vaccinations = Vaccination::where([
                      ['type','=','District'],
                      ['area_id','=',$district_id],
                    ])->get();

      foreach ($vaccinations as $vaccination) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$vaccination->area_id)->first();
        $district_vaccinations[] = array_merge($vaccination->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }

      return $district_vaccinations;
    }
}
