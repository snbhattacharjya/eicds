<?php

use Illuminate\Database\Seeder;
use App\State;
use App\District;
use App\IcdsProject;
use App\Sector;
use App\AnganwadiCentre;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = State::all();
        $districts = District::all();
        $projects = IcdsProject::all();
        $sectors = Sector::all();
        $centres = AnganwadiCentre::all();

        foreach ($states as $state) {
            $user = factory(App\User::class)->make([
              'type' => 'State',
              'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
            ]);
            $user->save();
            DB::table('area_user')->insert([
              'user_id' => $user->id,
              'user_type' => 'State',
              'area_id' => $state->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
        }

        foreach ($districts as $district) {
            $user = factory(App\User::class)->make([
              'type' => 'District',
              'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
            ]);
            $user->save();
            DB::table('area_user')->insert([
              'user_id' => $user->id,
              'user_type' => 'District',
              'area_id' => $district->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
        }

        foreach ($projects as $project) {
            $user = factory(App\User::class)->make([
              'type' => 'Project',
              'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
            ]);
            $user->save();
            DB::table('area_user')->insert([
              'user_id' => $user->id,
              'user_type' => 'Project',
              'area_id' => $project->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
        }

        foreach ($sectors as $sector) {
            $user = factory(App\User::class)->make([
              'type' => 'Sector',
              'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
            ]);
            $user->save();
            DB::table('area_user')->insert([
              'user_id' => $user->id,
              'user_type' => 'Sector',
              'area_id' => $sector->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
        }

        foreach ($centres as $centre) {
            $user = factory(App\User::class)->make([
              'type' => 'Center',
              'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
            ]);
            $user->save();
            DB::table('area_user')->insert([
              'user_id' => $user->id,
              'user_type' => 'Center',
              'area_id' => $centre->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);
        }

        $user = factory(App\User::class)->create([
          'type' => 'Central',
          'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
        ]);
    }
}
