<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
          'category_code' => 'SC',
          'category_name' => 'Scheduled Caste',
      ]);
      DB::table('categories')->insert([
          'category_code' => 'ST',
          'category_name' => 'Scheduled Tribe',
      ]);
      DB::table('categories')->insert([
          'category_code' => 'OTH',
          'category_name' => 'Others',
      ]);
    }
}
