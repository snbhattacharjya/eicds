<?php

namespace App\Http\Controllers;

use App\PreSchoolActivity;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
class PreSchoolActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = PreSchoolActivity::all();
        return view('preschoolactivity.index',['activities' => $activities]);
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
        if(Auth::user()->type == 'Central'){
          $activity->type = 'Central';
        }
        else{
          $activity->type = Auth::user()->type;
          $activity->area_id = Auth::user()->area->area_id;
        }
        $activity->save();

        Session::flash('success', 'New PreSchool Activity Added Successfully with ID: '.$activity->id);
        return redirect()->route('preschoolactivity.index');
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
