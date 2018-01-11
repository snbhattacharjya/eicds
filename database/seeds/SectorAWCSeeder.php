<?php

use Illuminate\Database\Seeder;
use App\IcdsProject;
use App\Sector;
class SectorAWCSeeder extends Seeder
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
          $sector = Sector::create([
            'project_id' => $project->id,
            'sector_code' => $project->id.'1',
            'sector_name' => 'Sector-'.'1',
            'created_at' => now(),
            'updated_at' => now(),
          ]);
          for ($i=1; $i <= 5; $i++) {
            DB::table('anganwadi_centres')->insert([
              'sector_id' => $sector->id,
              'centre_code' => $sector->id.$i,
              'centre_name' => 'AWC-'.$i,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
          }
        }
    }
}
