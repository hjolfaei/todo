<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Hjolfaei\Todo\Models\Task;;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;


$factory->define(Task::class, function (Faker $faker) {
    $user = Auth::user();
    return [
        'title' => $faker->jobTitle,
        'user_id' => $user->id,
        'description' => $faker->text,
        'status' => $faker->boolean
    ];
});



