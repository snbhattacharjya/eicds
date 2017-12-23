<?php

namespace App\Http\Controllers;

use App\IcdsProject;
use App\Sector;
use Illuminate\Http\Request;
use Session;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = IcdsProject::all();
        $sectors = Sector::all();
        return view('sector.index',['projects' => $projects, 'sectors' => $sectors]);
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
          'project_id' => 'required',
          'sector_code' => 'required|string|max:50|unique:sectors',
          'sector_name' => 'required|string|max:50|unique:sectors',
        ]);

        $sector = new Sector;
        $sector->project_id = $request->project_id;
        $sector->sector_code = $request->sector_code;
        $sector->sector_name = $request->sector_name;

        $sector->save();
        Session::flash('success','Icds Project Sector Added Successfully with ID: '.$sector->id);

        return redirect()->route('sector.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        //
    }
}
