<?php

namespace Hjolfaei\Todo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;


class TaskLabel extends Model
{
    protected $table = 'todo_task_label';
/*    protected $fillable = [
        'user_id',
        'task_id',
    ];*/
    protected $hidden = [
        'pivot'
    ];
    public $timestamps = false;
}
