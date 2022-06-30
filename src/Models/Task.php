<?php

namespace Hjolfaei\Todo\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;

class Task extends Model
{
    protected $table = 'todo_tasks';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        #customize the labels shown as total_labels
        'labels',
    ];

    #task_labels
    //m to n
    public function labels()
    {
        return $this->belongsToMany(Label::class, 'todo_task_label');

    }

    #user_tasks
    // 1 to n
    public function user()
    {
        return $this->belongsTo(User::class,'task_id');
    }


    //For UserExtend
/*    public function tasks()
    {
        return $this->hasMany(Task::class);
    }*/

}
