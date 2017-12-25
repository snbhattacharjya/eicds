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
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Hot Cooked Meal',
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Ready To Eat Food',
      ]);
      DB::table('supplementary_food_types')->insert([
        'type_name' => 'Take Home Ration',
      ]);
    }
}
