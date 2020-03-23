<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Publication;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Publication::class, function (Faker $faker) {

    $userId = User::query()->inRandomOrder()->limit(1)->first();

    return [
        'heading' => $faker->name,
        'description' => $faker->text,
        'user_id' => $userId,
    ];
});
