<?php

namespace App\Http\Controllers;

use App\PreSchoolActivity;
use Illuminate\Http\Request;
use Session;
class PreSchoolActivityController extends Controller
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
          'activity_name' => 'required|string|max:255',
        ]);
        $activity = new PreSchoolActivity;
        $activity->activity_name = $request->activity_name;
        $activity->save();

        Session::flash('success', 'New PreSchool Activity Added Successfully with ID: '.$activity->id);
        return redirect()->route('preschooleducation.create',['member' => $request->member_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function show(PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreSchoolActivity $preSchoolActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreSchoolActivity  $preSchoolActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreSchoolActivity $preSchoolActivity)
    {
        //
    }
}
