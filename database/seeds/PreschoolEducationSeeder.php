<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\IcdsProject;
use App\Member;
use App\PreSchoolEducationRecord;
use App\ActivityPreSchool;

class PreschoolEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $projects = IcdsProject::all();
      foreach ($projects as $project) {
        $members = DB::table('districts')
                  ->join('icds_projects', 'districts.id', '=', 'icds_projects.district_id')
                  ->join('sectors', 'icds_projects.id', '=', 'sectors.project_id')
                  ->join('anganwadi_centres', 'sectors.id', '=', 'anganwadi_centres.sector_id')
                  ->join('members', 'anganwadi_centres.id', '=', 'members.anganwadi_centre_id')
                  ->where([
                    ['members.target_id', '=', 3],
                    ['icds_projects.id', '=', $project->id]
                  ])
                  ->select('members.*')
                  ->inRandomOrder()
                  ->take(mt_rand(5,10))
                  ->get();
        foreach ($members as $member) {
          for ($i=1; $i <= 10 ; $i++) {
            $preschool_rec = new PreSchoolEducationRecord;
            $preschool_rec->family_id = $member->family_id;
            $preschool_rec->member_id = $member->id;
            $preschool_rec->target_type_id = $member->target_id;
            $preschool_rec->age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;
            $preschool_rec->anganwadi_centre_id = $member->anganwadi_centre_id;
            $preschool_rec->anganwadi_resident = $member->anganwadi_resident;
            $preschool_rec->attendance_date = date_create_from_format('Y-m-d','2018-01-'.$i);
            $preschool_rec->save();
          }
        }
      }

      $centres = DB::table('pre_school_education_records')
                  ->select('anganwadi_centre_id')
                  ->distinct()
                  ->get();
      foreach ($centres as $centre) {
        for ($i=1; $i <= 10 ; $i++) {
          $activity_preschool = new ActivityPreSchool;
          $activity_preschool->anganwadi_centre_id = $centre->anganwadi_centre_id;
          $activity_preschool->activity_id = 1;
          $activity_preschool->preschool_date =  date_create_from_format('Y-m-d','2018-01-'.$i);
          $activity_preschool->save();
        }
      }
    }
}
