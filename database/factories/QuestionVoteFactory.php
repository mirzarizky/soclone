<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\QuestionVote;
use App\User;
use Faker\Generator as Faker;

$factory->define(QuestionVote::class, function (Faker $faker) {
    return [
        'question_id' => factory(Question::class),
        'user_id' => factory(User::class),
        'vote' => $faker->boolean()
    ];
});
