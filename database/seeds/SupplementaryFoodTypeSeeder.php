<?php

use Illuminate\Database\Seeder;

class SupplementaryFoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Breakfast',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Hot Cooked Meal',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Ready To Eat Food',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Take Home Ration',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
}
