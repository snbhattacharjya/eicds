<?php

namespace App\Http\Controllers;

use App\VitaminADose;
use Illuminate\Http\Request;
use Session;

class VitaminADoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $dose->due_month_from_birth = $request->due_month_from_birth;

      $dose->save();
      Session::flash('success','New Vitamin A Dose Added Successfully with ID:'.$dose->id);
      return redirect()->route('vitamina.create',['member' => $request->member_id]);
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
