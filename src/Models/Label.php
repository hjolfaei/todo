<?php

namespace Hjolfaei\Todo\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;

class Label extends Model
{

    protected $table = 'todo_labels';

    protected $fillable = ['name'];


    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'tasks'
    ];
    #task_labels
    //m to n
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'todo_task_label');
    }




}
