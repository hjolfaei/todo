<?php
namespace Hjolfaei\Todo\Http\Traits;

use App\User;
use Hjolfaei\Todo\Models\Label;
use Hjolfaei\Todo\Models\Task;
use Hjolfaei\Todo\Models\UserExtend;
use Illuminate\Support\Facades\Auth;

trait TodoFunctions
{


    public function getUserSingleLabelInfo($label)
    {

        $user = Auth::user();
        //$user = UserExtend::find($user->id);

        #User tasks inside this label
        $userTasks = $label->tasks->where('user_id','==',$user->id);
        $label -> total_tasks = count($userTasks);

        return $label;
    }

    public function getUserSingleTaskInfo($task)
    {
        $user = Auth::user();
        //Get this task labels and count how many tasks user have in every label.
        $taskLabels = $task->labels;
        $labelsInfo = null;
        foreach ($taskLabels as $key => $label){
            //Save labels inside an array
            $labelsInfo[$key] = $this->getUserSingleLabelInfo($label);
        }
        return $labelsInfo;
    }


    public function jsonAuth()
    {
        $user = Auth::user();
        if (empty($user) && !($user instanceof User)){
            return response([
                'message' => 'Unauthenticated'
            ], 403);
        }
        return $user;
    }


    public function validateTask($task,$userId)
    {
        if (empty($task) && !($task instanceof Task)){
            return response(['message','Task not exist.'],404);
        }elseif ($userId !== $task->user_id){
            return response(['message','Task belongs to another user.'],403);
        }
    }

    public function validateLabel($label)
    {
        if (empty($label) && !($label instanceof Label)){
            return response(['message','Label not exist.'],404);
        }
    }
}
