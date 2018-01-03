<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $family = factory(App\FamilyDetail::class)
          ->create()
          ->each(function($f){
              $member = factory(App\Member::class)->make([
                'family_id' => $f->id,
                'name' => $f->hof_name,
              ]);
              $member->save();

              //Creating Mother
              $pregnant_mother = factory(App\Member::class)->make([
                'family_id' => $f->id,
                'relation' => 'Other',
                'gender' => 'F',
                'marital_status' => 'Married',
                'dob' => date_format(date_sub(date_create(date('Y-m-d')),date_interval_create_from_date_string(mt_rand(20,30)." years")),'Y-m-d'),
                'target_id' => 1,
              ]);
              $pregnant_mother->save();

              $lactating_mother = factory(App\Member::class)->make([
                'family_id' => $f->id,
                'relation' => 'Other',
                'gender' => 'F',
                'marital_status' => 'Married',
                'dob' => date_format(date_sub(date_create(date('Y-m-d')),date_interval_create_from_date_string(mt_rand(20,30)." years")),'Y-m-d'),
                'target_id' => 2,
              ]);
              $lactating_mother->save();

              //Creating Child
              $girl_child = factory(App\Member::class)->make([
                'family_id' => $f->id,
                'relation' => 'Other',
                'gender' => 'F',
                'marital_status' => 'Unmarried',
                'dob' => date_format(date_sub(date_create(date('Y-m-d')),date_interval_create_from_date_string(mt_rand(30,360)." days")),'Y-m-d'),
                'target_id' => 3,
              ]);
              $girl_child->save();

              $boy_child = factory(App\Member::class)->make([
                'family_id' => $f->id,
                'relation' => 'Other',
                'gender' => 'M',
                'marital_status' => 'Unmarried',
                'dob' => date_format(date_sub(date_create(date('Y-m-d')),date_interval_create_from_date_string(mt_rand(30,360)." days")),'Y-m-d'),
                'target_id' => 3,
              ]);
              $boy_child->save();

              DB::table('family_migrations')->insert([
                'family_id' => $f->id,
                'member_id' => $member->id,
                'target_id' => $member->target_id,
                'anganwadi_centre_id' => $member->anganwadi_centre_id,
                'anganwadi_resident' => 'Y',
                'type' => 'IN',
                'remarks' => 'New Family',
                'created_at' => now(),
                'updated_at' => now(),
              ]);

              //Family Migrations
              DB::table('family_migrations')->insert([
                'family_id' => $f->id,
                'member_id' => $pregnant_mother->id,
                'target_id' => $pregnant_mother->target_id,
                'anganwadi_centre_id' => $pregnant_mother->anganwadi_centre_id,
                'anganwadi_resident' => 'Y',
                'type' => 'IN',
                'remarks' => 'New Family',
                'created_at' => now(),
                'updated_at' => now(),
              ]);

              DB::table('family_migrations')->insert([
                'family_id' => $f->id,
                'member_id' => $lactating_mother->id,
                'target_id' => $lactating_mother->target_id,
                'anganwadi_centre_id' => $lactating_mother->anganwadi_centre_id,
                'anganwadi_resident' => 'Y',
                'type' => 'IN',
                'remarks' => 'New Family',
                'created_at' => now(),
                'updated_at' => now(),
              ]);

              DB::table('family_migrations')->insert([
                'family_id' => $f->id,
                'member_id' => $girl_child->id,
                'target_id' => $girl_child->target_id,
                'anganwadi_centre_id' => $girl_child->anganwadi_centre_id,
                'anganwadi_resident' => 'Y',
                'type' => 'IN',
                'remarks' => 'New Family',
                'created_at' => now(),
                'updated_at' => now(),
              ]);

              DB::table('family_migrations')->insert([
                'family_id' => $f->id,
                'member_id' => $boy_child->id,
                'target_id' => $boy_child->target_id,
                'anganwadi_centre_id' => $boy_child->anganwadi_centre_id,
                'anganwadi_resident' => 'Y',
                'type' => 'IN',
                'remarks' => 'New Family',
                'created_at' => now(),
                'updated_at' => now(),
              ]);
          });
    }
}
