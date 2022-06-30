<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Hjolfaei\Todo\Models\TaskLabel;
use Hjolfaei\Todo\Models\Task;
use Hjolfaei\Todo\Models\Label;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;


$factory->define(TaskLabel::class, function (Faker $faker) {

    $user = Auth::user();
    $tasks = Task::all()->where('user_id','==',$user->id);
    $labels = Label::all();

    do{
        $taskId = $tasks->random()->id;
        $labelId = $labels->random()->id;
        $duplicate = $labels->where('task_id','==' , $taskId)->where('label_id','==', $labelId);
    }
    while (empty($duplicate));
    return [
        'task_id' => $taskId,
        'label_id' => $labelId,
    ];
});



