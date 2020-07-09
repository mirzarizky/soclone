<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\AnswerVote;
use App\User;
use Faker\Generator as Faker;

$factory->define(AnswerVote::class, function (Faker $faker) {
    return [
        'answer_id' => factory(Answer::class),
        'user_id' => factory(User::class),
        'vote' => $faker->boolean()
    ];
});
