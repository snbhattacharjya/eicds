<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    $gender = ['M','F'];
    $marital_status = ['Married','Unmarried'];
    return [
      'name' => $faker->name,
      'aadhaar' => mt_rand(1000,2000).mt_rand(3000,4000).mt_rand(5000,6000),
      'relation' => 'Self',
      'gender' => $gender[rand(0,1)],
      'marital_status' => $marital_status[rand(0,1)],
      'dob' => $faker->date,
      'target_id' => 5,
      'disability_id' => 6,
      'anganwadi_centre_id' => 1,
      'anganwadi_resident' => 'Y',
      'mobile' => substr($faker->e164PhoneNumber,2,10),
    ];
});
