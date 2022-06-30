<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Hjolfaei\Todo\Models\Label;;
use Hjolfaei\Todo\Models\Task;
use Faker\Generator as Faker;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word),
    ];
});
