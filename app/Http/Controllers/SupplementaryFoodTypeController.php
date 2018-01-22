<?php

namespace App\Http\Controllers;

use App\SupplementaryFoodType;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplementaryFoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->type == 'Central'){
        $central_food_types = $this->getCentralFoodTypes();
        $state_food_types = $this->getAllStateFoodTypes();
        $district_food_types = $this->getAllDistrictFoodTypes();

        $food_types = array_merge($central_food_types,$state_food_types,$district_food_types);
        $food_types = collect($food_types);
      }
      else if(Auth::user()->type == 'State'){
        $central_food_types = $this->getCentralFoodTypes();
        $state_food_types = $this->getOnlyStateFoodTypes(Auth::user()->area->area_id);

        $food_types = array_merge($central_food_types,$state_food_types);
        $food_types = collect($food_types);
      }
      else {
        $central_food_types = $this->getCentralFoodTypes();
        $district_food_types = $this->getOnlyDistrictFoodTypes(Auth::user()->area->area_id);

        $food_types = array_merge($central_food_types,$district_food_types);
        $food_types = collect($food_types);
      }

      return view('supplementaryfoodtype.index',['food_types' => $food_types]);
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
        'type_name' => 'required|string|max:255',
      ]);
      $food_type = new SupplementaryFoodType;
      $food_type->type_name = $request->type_name;
      if(Auth::user()->type == 'Central'){
        $food_type->type = 'Central';
      }
      else{
        $food_type->type = Auth::user()->type;
        $food_type->area_id = Auth::user()->area->area_id;
      }
      $food_type->save();

      Session::flash('success', 'New Supplementary Food Type Added Successfully with ID: '.$food_type->id);
      return redirect()->route('supplementaryfoodtype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupplementaryFoodType  $supplementaryFoodType
     * @return \Illuminate\Http\Response
     */
    public function show(SupplementaryFoodType $supplementaryFoodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupplementaryFoodType  $supplementaryFoodType
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplementaryFoodType $supplementaryFoodType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupplementaryFoodType  $supplementaryFoodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplementaryFoodType $supplementaryFoodType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupplementaryFoodType  $supplementaryFoodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplementaryFoodType $supplementaryFoodType)
    {
        //
    }

    public function getCentralFoodTypes(){
      return SupplementaryFoodType::where('type', 'Central')->get()->toArray();
    }

    public function getAllStateFoodTypes(){
      $food_types = SupplementaryFoodType::where('type', 'State')->get();
      $state_food_types = array();
      foreach ($food_types as $food_type) {
        $area = DB::table('states')->where('id',$food_type->area_id)->first();
        $state_food_types[] = array_merge($food_type->toArray(),['supported_by' => $area->state_name]);
      }
      return $state_food_types;
    }

    public function getAllDistrictFoodTypes(){
      $food_types = SupplementaryFoodType::where('type', 'District')->get();
      $district_food_types = array();
      foreach ($food_types as $food_type) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$food_type->area_id)->first();
        $district_food_types[] = array_merge($food_type->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }
      return $district_food_types;
    }

    public function getOnlyStateFoodTypes(int $state_id){
      $food_types = SupplementaryFoodType::where([
                      ['type','=','State'],
                      ['area_id','=',$state_id],
                    ])->get();
      $state_food_types = array();
      foreach ($food_types as $food_type) {
        $area = DB::table('states')->where('id',$food_type->area_id)->first();
        $state_food_types[] = array_merge($food_type->toArray(),['supported_by' => $area->state_name]);
      }

      $food_types = DB::table('supplementary_food_types')
                    ->join('districts','supplementary_food_types.area_id','=','districts.id')
                    ->join('states','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','District'],
                        ['states.id','=',$state_id],
                      ])
                    ->select('supplementary_food_types.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($food_types as $food_type) {
        $state_food_types[] = array('id' => $food_type->id, 'type_name' => $food_type->type_name, 'type' => $food_type->type, 'supported_by' => $food_type->district_name.', '.$food_type->state_name);
      }
      return $state_food_types;
    }

    public function getOnlyDistrictFoodTypes(int $district_id){
      $district_food_types = array();
      //Get State FoodTypes for the district
      $food_types = DB::table('supplementary_food_types')
                    ->join('states','supplementary_food_types.area_id','=','states.id')
                    ->join('districts','states.id','=','districts.state_id')
                    ->where([
                        ['type','=','State'],
                        ['districts.id','=',$district_id],
                      ])
                    ->select('supplementary_food_types.*','states.state_name','districts.district_name')
                    ->get();
      foreach ($food_types as $food_type) {
        $district_food_types[] = array('id' => $food_type->id, 'type_name' => $food_type->type_name, 'type' => $food_type->type, 'supported_by' => $food_type->state_name);
      }
      //Get District Specific FoodTypes
      $food_types = SupplementaryFoodType::where([
                      ['type','=','District'],
                      ['area_id','=',$district_id],
                    ])->get();

      foreach ($food_types as $food_type) {
        $area = DB::table('districts')
                ->join('states','states.id','=','districts.state_id')
                ->select('states.state_name','districts.district_name')
                ->where('districts.id',$food_type->area_id)->first();
        $district_food_types[] = array_merge($food_type->toArray(),['supported_by' => $area->district_name.', '.$area->state_name]);
      }

      return $district_food_types;
    }
}
