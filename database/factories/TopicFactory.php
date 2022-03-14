<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Topic;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

