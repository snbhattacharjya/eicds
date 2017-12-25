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
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'L',
          'target_name' => 'Lactating',
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'C',
          'target_name' => 'Child',
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'A',
          'target_name' => 'Adolescent Girl',
        ]);
        DB::table('target_types')->insert([
          'target_name_short' => 'N',
          'target_name' => 'Non Beneficiary',
        ]);
    }
}
