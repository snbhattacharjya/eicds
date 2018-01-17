<?php

namespace App\Http\Controllers;

use App\MedicalProcedure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class MedicalProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $procedures = MedicalProcedure::all();
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
}
