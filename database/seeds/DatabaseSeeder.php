<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateSeeder::class);
        $this->call(WBDistrictSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TargetTypeSeeder::class);
        $this->call(DisabilityTypeSeeder::class);
        $this->call(IcdsServiceSeeder::class);
        $this->call(SupplementaryFoodTypeSeeder::class);
    }
}
