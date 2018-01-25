<?php

namespace App\Http\Controllers;

use App\Member;
use App\FamilyDetail;
use Illuminate\Http\Request;
use Session;
use App\FamilyMigration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
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
        'member_name' => 'required|string|max:255',
        'relation' => 'required|string|max:255',
        'aadhaar' => 'required|digits:12',
        'gender' => 'required',
        'dob' => 'date_format:d/m/Y|before:tomorrow',
        'marital_status' => 'required|string',
        'target_id' => 'required|string',
        'disability_id' => 'required|string',
        'anganwadi_resident' => 'required|string',
        'mobile' => 'required|digits:10',
      ]);

      $member =  new Member;
      $member->family_id = $request->family_id;
      $member->name = $request->member_name;
      $member->aadhaar = $request->aadhaar;
      $member->gender = $request->gender;
      $member->dob = date_format(date_create_from_format('d/m/Y',$request->dob),'Y-m-d');
      $member->marital_status = $request->marital_status;
      $member->target_id = $request->target_id;
      $member->disability_id = $request->disability_id;
      $member->anganwadi_resident = $request->anganwadi_resident;
      $member->mobile = $request->mobile;
      $member->relation = $request->relation;
      $member->anganwadi_centre_id = Auth::user()->area->area_id;
      $member->active_status = 1;

      $member->save();

      Session::flash('success','Member Added Successfully with ID: '.$member->id);
      return redirect()->route('familydetail.showMembers',['family_id' => $member->family_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    public function showImport(Request $request){
      $request->validate([
        'aadhaar' => 'required|digits:12',
      ]);
      $family_head = FamilyDetail::where('id',$request->family_id)->pluck('hof_name')->first();
      $member = Member::where([
        ['aadhaar', '=', $request->aadhaar],
        //['anganwadi_centre_id', '<>', Auth::user()->area->area_id],
        ])->first();
      return view('familydetail.show_member_import',['member' => $member, 'family_id' => $request->family_id, 'family_head' => $family_head]);
    }

    public function import(Request $request)
    {
        $request->validate([
          'remarks' => 'required|string|max:255',
        ]);

        $member = Member::find($request->member_id);

        $migration = new FamilyMigration;
        $migration->family_id = $member->family_id;
        $migration->member_id = $member->id;
        $migration->target_id = $member->target_id;
        $migration->anganwadi_centre_id = $member->anganwadi_centre_id;
        $migration->anganwadi_resident = $member->anganwadi_resident;
        $migration->type = 'OUT';
        $migration->remarks = $request->remarks;
        $migration->save();

        $member->family_id = $request->family_id;
        $member->anganwadi_centre_id = Auth::user()->area->area_id;
        $member->anganwadi_resident = 'N';
        $member->save();

        $migration = new FamilyMigration;
        $migration->family_id = $member->family_id;
        $migration->member_id = $member->id;
        $migration->target_id = $member->target_id;
        $migration->anganwadi_centre_id = $member->anganwadi_centre_id;
        $migration->anganwadi_resident = $member->anganwadi_resident;
        $migration->type = 'IN';
        $migration->remarks = 'Join Family';
        $migration->save();


        Session::flash('success','Member Imported Successfully with ID: '.$member->id);
        return redirect()->route('familydetail.showMembers',['family_id' => $member->family_id]);
    }

    public function getStateBeneficiaries(){
      $data = DB::table('states')
          ->join('districts','states.id','=','districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('states.state_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as Count')
          ->where([
            ['members.active_status', '=', 1],
          ])
          ->whereNotIn('members.target_id',[5])
          ->groupBy('states.state_name', 'target_types.target_name')
          ->get()->toArray();
      return response()->json($data,200);
    }

    public function getDistrictBeneficiaries(){
      $data = DB::table('states')
          ->join('districts','states.id','=','districts.state_id')
          ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
          ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
          ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
          ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
          ->join('target_types', 'members.target_id', '=', 'target_types.id')
          ->select('districts.district_name', 'target_types.target_name')
          ->selectRaw('COUNT(*) as Count')
          ->where([
            ['members.active_status', '=', 1],
          ])
          ->whereNotIn('members.target_id',[5])
          ->groupBy('districts.district_name', 'target_types.target_name')
          ->get()->toArray();
      return response()->json($data,200);
    }
}
