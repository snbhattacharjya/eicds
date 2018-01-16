<?php

namespace App\Http\Controllers;

use App\NewBornDetail;
use Illuminate\Http\Request;
use App\PregnancyDeliveryRecord;
use App\Member;
use Session;
use Illuminate\Support\Facades\Auth;

class NewBornDetailController extends Controller
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
        'child_name' => 'required|string',
        'mode_of_delivery' => 'required|string',
        'delivery_location_type' => 'required|string',
        'delivery_location_name' => 'required|string',
        'village_town_name' => 'required|string',
        'doctor_name' => 'required|string',
        'pediatrician_name' => 'required|string',
        'birth_status' => 'required|string',
        'birth_date_time' => 'date_format:d/m/Y H:i|before:tomorrow',
        'gender' => 'required|string',
        'first_weight' => 'required|numeric',
        'first_weight_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $pd_record = PregnancyDeliveryRecord::find($request->pregnancy_id);
      $new_born = new NewBornDetail;
      $new_born->family_id = $pd_record->family_id;
      $new_born->mother_id = $pd_record->member_id;
      $new_born->pregnancy_id = $pd_record->id;
      $new_born->mode_of_delivery = $request->mode_of_delivery;
      $new_born->delivery_location_type = $request->delivery_location_type;
      $new_born->delivery_location_name = $request->delivery_location_name;
      $new_born->village_town_name = $request->village_town_name;
      $new_born->doctor_name = $request->doctor_name;
      $new_born->pediatrician_name = $request->pediatrician_name;
      $new_born->birth_status = $request->birth_status;
      $new_born->birth_date_time = date_format(date_create_from_format('d/m/Y H:i',$request->birth_date_time),'Y-m-d H:i');
      $new_born->gender = $request->gender;
      $new_born->first_weight = $request->first_weight;
      $new_born->first_weight_date = date_format(date_create_from_format('d/m/Y',$request->first_weight_date),'Y-m-d');

      $new_member = new Member;
      $new_member->family_id = $pd_record->family_id;
      $new_member->name = $request->child_name;
      $new_member->gender = $request->gender;
      $new_member->aadhaar = mt_rand(1999,9999);//Setting a random aadhaar
      $new_member->dob = date_format(date_create_from_format('d/m/Y H:i',$request->birth_date_time),'Y-m-d');
      $new_member->marital_status = 'Unmarried';
      $new_member->target_id = 3;
      $new_member->disability_id = 6;
      $new_member->anganwadi_resident = $pd_record->anganwadi_resident;
      $new_member->relation = 'Other';
      $new_member->anganwadi_centre_id = Auth::user()->area->area_id;
      if($new_born->birth_status == 'Live'){
        $new_member->active_status = 1;
      }
      else {
        $new_member->active_status = 0;
      }
      $new_member->save();
      $new_born->child_id = $new_member->id;
      $new_born->save();
      //Updating Aadhaar
      $new_member = Member::find($new_member->id);
      $new_member->aadhaar = $new_member->id;
      $new_member->save();

      Session::flash('success','New Born Added Successfully with ID: '.$new_born->child_id);
      return redirect()->route('pregnancydelivery.newborn',['id' => $pd_record->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewBornDetail  $newBornDetail
     * @return \Illuminate\Http\Response
     */
    public function show(NewBornDetail $newBornDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewBornDetail  $newBornDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(NewBornDetail $newBornDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewBornDetail  $newBornDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewBornDetail $newBornDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewBornDetail  $newBornDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewBornDetail $newBornDetail)
    {
        //
    }
}
