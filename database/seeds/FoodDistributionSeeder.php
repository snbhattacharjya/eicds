<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\AnganwadiCentre;
use App\Member;
use App\SupplementaryFoodDistribution;
use App\SupplementaryDistributionFoodType;

class FoodDistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centres = AnganwadiCentre::all();
        $quantity = ['N','L'];
        $food_types = [1,2,3,4];
        foreach ($centres as $centre) {
          $members = Member::whereIn('target_id',[1,2,3])
                    ->where('anganwadi_centre_id',$centre->id)
                    ->inRandomOrder()
                    ->take(mt_rand(5,10))
                    ->get();
          foreach ($members as $member) {
            for ($i=1; $i <= 10 ; $i++) {
              $distribution = new SupplementaryFoodDistribution;
              $distribution->family_id = $member->family_id;
              $distribution->member_id = $member->id;
              $distribution->target_type_id = $member->target_id;
              $distribution->age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;
              $distribution->anganwadi_centre_id = $member->anganwadi_centre_id;
              $distribution->anganwadi_resident = $member->anganwadi_resident;
              $distribution->ration_given_date = date_create_from_format('Y-m-d','2018-01-'.$i);
              $distribution->ration_given_quantity = $quantity[mt_rand(0,1)];
              $distribution->created_at = now();
              $distribution->updated_at = now();

              $distribution->save();
              $food_type =  mt_rand(1,4);
              for ($j=0; $j < $food_type; $j++) {
                $distribution_food_type = new SupplementaryDistributionFoodType;
                $distribution_food_type->distribution_id = $distribution->id;
                $distribution_food_type->food_type_id = $food_types[$j];
                $distribution_food_type->save();
              }
            }
          }
        }

    }
}
