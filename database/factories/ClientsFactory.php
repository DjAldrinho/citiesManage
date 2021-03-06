<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->isbn10,
        //'city_id' => factory(App\City::class)
    ];
});
