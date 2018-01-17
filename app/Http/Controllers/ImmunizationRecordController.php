<?php

namespace App\Http\Controllers;

use App\ImmunizationRecord;
use Illuminate\Http\Request;
use App\Member;
use App\Vaccination;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImmunizationRecordController extends Controller
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
            ['target_id', '=', 3],
            ['anganwadi_centre_id', '=', Auth::user()->area->area_id],
          ])->get();
        return view('immunization.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
        $member = Member::find($member_id);
        $area = DB::table('states')
            ->join('districts', 'states.id', '=', 'districts.state_id')
            ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
            ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
            ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
            ->select('states.id as state_id', 'districts.id as district_id')
            ->where([
              ['anganwadi_centres.id', '=', Auth::user()->area->area_id],
            ])
            ->first();
        $vaccinations = Vaccination::where('type', '=', 'Central')
                      ->orWhere(function ($query) use($area) {
                          $query->where('type', '=', 'State')
                                ->where('area_id', '=', $area->state_id);
                        })
                        ->orWhere(function ($query) use($area) {
                            $query->where('type', '=', 'District')
                                  ->where('area_id', '=', $area->district_id);
                          })->get();
        return view('immunization.create',['member' => $member, 'vaccinations' => $vaccinations]);
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
        'vaccination_id' => 'required',
        'due_date' => 'date_format:d/m/Y|before:tomorrow',
        'admin_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $vaccinations = Vaccination::all();

      $member =  Member::find($request->member_id);
      $immunization = new ImmunizationRecord;
      $immunization->family_id = $member->family_id;
      $immunization->member_id = $member->id;
      $immunization->target_type_id = $member->target_id;

      $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m/12;

      $immunization->age = $age;
      $immunization->vaccination_id = $request->vaccination_id;
      $immunization->vaccination_due_date = date_format(date_create_from_format('d/m/Y',$request->due_date),'Y-m-d');
      $immunization->vaccination_admin_date = date_format(date_create_from_format('d/m/Y',$request->admin_date),'Y-m-d');
      $immunization->anganwadi_centre_id = Auth::user()->area->area_id;

      $immunization->save();
      Session::flash('success','Immunization Record Added Successfully with ID: '.$immunization->id);
      return redirect()->route('immunization.create',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImmunizationRecord  $immunizationRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ImmunizationRecord $immunizationRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImmunizationRecord  $immunizationRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(ImmunizationRecord $immunizationRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImmunizationRecord  $immunizationRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImmunizationRecord $immunizationRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImmunizationRecord  $immunizationRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImmunizationRecord $immunizationRecord)
    {
        //
    }
}
