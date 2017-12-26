<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TargetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('target_types')->insert([
          'target_name_short' => 'P',
          'target_name' => 'Pregnant',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'L',
          'target_name' => 'Lactating',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'C',
          'target_name' => 'Child',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'A',
          'target_name' => 'Adolescent Girl',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'N',
          'target_name' => 'Non Beneficiary',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
    }
}
