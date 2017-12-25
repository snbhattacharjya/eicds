<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DisabilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Movement',
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Mental',
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Seeing',
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Hearing',
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Speaking',
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Not Applicable',
      ]);
    }
}
