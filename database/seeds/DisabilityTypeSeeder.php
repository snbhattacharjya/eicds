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
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Mental',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Seeing',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Hearing',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Speaking',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('disability_types')->insert([
        'disability_type_name' => 'Not Applicable',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
}
