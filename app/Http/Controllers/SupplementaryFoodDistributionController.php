<?php

namespace App\Http\Controllers;

use App\SupplementaryFoodDistribution;
use Illuminate\Http\Request;
use App\Member;
use App\SupplementaryFoodType;
use Session;
use Illuminate\Support\Facades\Auth;

class SupplementaryFoodDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::where([
            ['active_status', '=', 1],
            ['target_id', '<>', 5],
            ['anganwadi_centre_id', '=', Auth::user()->area->area_id],
          ])->get();
        return view('fooddistribution.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
        $member = Member::find($member_id);
        $food_types = SupplementaryFoodType::all();
        return view('fooddistribution.create',['member' => $member, 'food_types' => $food_types]);
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
          'food_type' => 'required',
          'ration_given_quantity' => 'required',
          'ration_given_date' => 'date_format:d/m/Y|before:tomorrow',
        ]);

        $member =  Member::find($request->member_id);
        $distribution = new SupplementaryFoodDistribution;
        $distribution->family_id = $member->family_id;
        $distribution->member_id = $member->id;
        $distribution->target_type_id = $member->target_id;
        $distribution->anganwadi_resident = $member->anganwadi_resident;

        $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;
        $distribution->age = $age;
        $distribution->ration_given_quantity = $request->ration_given_quantity;
        $distribution->ration_given_date = date_format(date_create_from_format('d/m/Y',$request->ration_given_date),'Y-m-d');
        $distribution->anganwadi_centre_id = Auth::user()->area->area_id;

        $distribution->save();
        $distribution->saveFoodType($request->food_type);
        Session::flash('success','Food Distribution Added Successfully with ID: '.$distribution->id);
        return redirect()->route('fooddistribution.create',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupplementaryFoodDistribution  $supplementaryFoodDistribution
     * @return \Illuminate\Http\Response
     */
    public function show(SupplementaryFoodDistribution $supplementaryFoodDistribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupplementaryFoodDistribution  $supplementaryFoodDistribution
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplementaryFoodDistribution $supplementaryFoodDistribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupplementaryFoodDistribution  $supplementaryFoodDistribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplementaryFoodDistribution $supplementaryFoodDistribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupplementaryFoodDistribution  $supplementaryFoodDistribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplementaryFoodDistribution $supplementaryFoodDistribution)
    {
        //
    }
}
