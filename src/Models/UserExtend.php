<?php

namespace Hjolfaei\Todo\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;
class UserExtend extends User
{

    protected $table = 'users';


    #user_tasks
    // 1 + n
        public function tasks()
        {
            return $this->hasMany(Task::class,'user_id');
        }


}
