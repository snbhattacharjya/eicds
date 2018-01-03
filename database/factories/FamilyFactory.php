<?php

use Faker\Generator as Faker;

$factory->define(App\FamilyDetail::class, function (Faker $faker) {
    $minority = ['Y','N'];
    $category = [1,2,3];
    return [
        'hof_name' => $faker->name,
        'category_id' => $category[rand(0,2)],
        'minority' => $minority[rand(0,1)],
        'bpl' => $minority[rand(0,1)],
        'address' => $faker->address,
        'village_town_name' => $faker->streetName,
        'pincode' => $faker->randomNumber(6),
    ];
});
