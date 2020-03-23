<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnswerComment;
use App\Models\Comment;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(AnswerComment::class, function (Faker $faker) {

    $userId = User::query()->inRandomOrder()->limit(1)->first();
    $commentId = Comment::query()->inRandomOrder()->limit(1)->first();

    return [
        'user_id' => $userId,
        'comment_id' =>$commentId,
        'text' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
