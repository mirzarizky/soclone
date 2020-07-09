<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\AnswerComment;
use Faker\Generator as Faker;

$factory->define(AnswerComment::class, function (Faker $faker) {
    return [
        'answer_id' => factory(Answer::class),
        'user_id' => factory(User::class),
        'content' => $faker->paragraph(5)
    ];
});
