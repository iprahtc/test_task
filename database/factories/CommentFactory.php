<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $userId = User::query()->inRandomOrder()->limit(1)->first();
    $publicationId = Publication::query()->inRandomOrder()->limit(1)->first();

    return [
        'user_id' => $userId,
        'publication_id' =>$publicationId,
        'text' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
