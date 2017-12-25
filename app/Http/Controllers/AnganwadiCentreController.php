<?php

namespace App\Http\Controllers;

use App\AnganwadiCentre;
use App\Sector;
use Illuminate\Http\Request;
use Session;

class AnganwadiCentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::all();
        $centres = AnganwadiCentre::all();
        return view('anganwadicentre.index',['sectors' => $sectors, 'centres' => $centres]);
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
          'sector_id' => 'required',
          'centre_code' => 'required|string|max:50|unique:anganwadi_centres',
          'centre_name' => 'required|string|max:50|unique:anganwadi_centres',
        ]);

        $centre = new AnganwadiCentre;
        $centre->sector_id = $request->sector_id;
        $centre->centre_code = $request->centre_code;
        $centre->centre_name = $request->centre_name;

        $centre->save();
        Session::flash('success','Anganwadi Centre Added Successfully with ID: '.$centre->id);

        return redirect()->route('anganwadicentre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnganwadiCentre  $anganwadiCentre
     * @return \Illuminate\Http\Response
     */
    public function show(AnganwadiCentre $anganwadiCentre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnganwadiCentre  $anganwadiCentre
     * @return \Illuminate\Http\Response
     */
    public function edit(AnganwadiCentre $anganwadiCentre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnganwadiCentre  $anganwadiCentre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnganwadiCentre $anganwadiCentre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnganwadiCentre  $anganwadiCentre
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnganwadiCentre $anganwadiCentre)
    {
        //
    }
}
