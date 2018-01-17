<?php

namespace App\Http\Controllers;

use App\SupplementaryFoodType;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class SupplementaryFoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $food_types = SupplementaryFoodType::all();
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
}
