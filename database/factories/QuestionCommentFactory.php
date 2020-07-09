<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\QuestionComment;
use App\User;
use Faker\Generator as Faker;

$factory->define(QuestionComment::class, function (Faker $faker) {
    return [
        'question_id' => factory(Question::class),
        'user_id' => factory(User::class),
        'content' => $faker->paragraph(5)
    ];
});
