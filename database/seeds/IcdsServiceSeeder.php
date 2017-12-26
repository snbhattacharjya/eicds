<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IcdsServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('icds_services')->insert([
        'icds_service_name' => 'Supplementary Nutrition Program',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('icds_services')->insert([
        'icds_service_name' => 'Preschool Education',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
}
