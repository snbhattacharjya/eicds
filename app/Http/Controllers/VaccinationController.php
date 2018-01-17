<?php

namespace App\Http\Controllers;

use App\Vaccination;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccinations = Vaccination::all();
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
}
