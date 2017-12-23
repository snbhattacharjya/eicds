<?php

namespace App\Http\Controllers;

use App\District;
use App\IcdsProject;
use Illuminate\Http\Request;
use Session;

class IcdsProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        $projects = IcdsProject::all();
        return view('icdsproject.index',['districts' => $districts, 'projects' => $projects]);
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
          'district_id' => 'required',
          'project_code' => 'required|string|max:50',
          'project_name' => 'required|string|max:50',
        ]);

        $project = new IcdsProject;
        $project->district_id = $request->district_id;
        $project->project_code = $request->project_code;
        $project->project_name = $request->project_name;

        $project->save();
        Session::flash('success','Icds Project Added Successfully with ID: '.$project->id);

        return redirect()->route('icdsproject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IcdsProject  $icdsProject
     * @return \Illuminate\Http\Response
     */
    public function show(IcdsProject $icdsProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IcdsProject  $icdsProject
     * @return \Illuminate\Http\Response
     */
    public function edit(IcdsProject $icdsProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IcdsProject  $icdsProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IcdsProject $icdsProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IcdsProject  $icdsProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(IcdsProject $icdsProject)
    {
        //
    }
}
