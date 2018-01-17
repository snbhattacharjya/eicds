<?php

namespace App\Http\Controllers;

use App\VitaminADose;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class VitaminADoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doses = VitaminADose::all();
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
}
