<?php

namespace Hjolfaei\Todo\Http\Controllers;


use Hjolfaei\Todo\Http\Requests\TasksRequest;
use Hjolfaei\Todo\Http\Resources\LabelsResource;
use Hjolfaei\Todo\Http\Traits\TodoFunctions;
use Hjolfaei\Todo\Models\Label;
use Hjolfaei\Todo\Models\Task;
use App\Http\Controllers\Controller;;
use Hjolfaei\Todo\Http\Resources\TasksResource;
use Hjolfaei\Todo\Notifications\TaskNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;


define('LABELS','task_labels');

class TasksController extends Controller
{
    use TodoFunctions;

    public function index()
    {
        $user = $this->jsonAuth();

        //Get current user tasks.
        $tasks = Task::all();
        $tasks = $tasks->where('user_id','==',$user->id);

        //Get task labels one by one.
        foreach ($tasks as $taskKey => $task){
            $labelsInfo = $this->getUserSingleTaskInfo($task);
            //Adding each task labels data
            #LABELS Defined
            $tasks[$taskKey]->LABELS = $labelsInfo;
        }

        return TasksResource::collection($tasks);

    }


    public function create()
    {
        //
    }

    public function store(TasksRequest $tasksRequest)
    {
        #Create Task
        $user = $this->jsonAuth();
        $inputData = [
            'title' => $tasksRequest->input('title'),
            'user_id' => $user->id,
            'description' => $tasksRequest->input('description'),
        ];
        $inputLabels = $tasksRequest->input('label');
        $labelsId = array_map('intval', explode(',', $inputLabels));


        $validatedLabels = null;
        foreach ($labelsId as $labelId){
            $label = Label::find($labelId);
            if (!empty($label) && $label instanceof Label){
                $validatedLabels[] = $labelId;
            }else{
                return response(['message','Label id '.$labelId.' not found.'],404);
            }
        }
        $task = Task::create($inputData);
        $task->labels()->attach($labelId);

        //Adding task labels to show.
        #LABELS Defined
        $labelsInfo = $this->getUserSingleTaskInfo($task);
        $task->LABELS = $labelsInfo;



        return new TasksResource($task);
    }


    public function show($id)
    {
        $user = $this->jsonAuth();
        $task = Task::find($id);
        validateTask($task,$user->id);

        //Adding task labels to show.
        #LABELS Defined
        $labelsInfo = $this->getUserSingleTaskInfo($task);
        $task->LABELS = $labelsInfo;

        return new TasksResource($task);
    }


    public function edit(Task $Task)
    {
        //
    }


    public function update(TasksRequest $tasksRequest, $id)
    {
        #Update Task


        $user = $this->jsonAuth();
        $task = Task::find($id);
        validateTask($task,$user->id);



        $inputData = [
            'title' => $tasksRequest->input('title'),
            'user_id' => $user->id,
            'description' => $tasksRequest->input('description'),
            'status' => $tasksRequest->input('status'),
        ];
        if (empty($tasksRequest->input('status'))){
            unset($inputData['status']);
        }


        $inputLabels = $tasksRequest->input('label');
        $labelsId = array_map('intval', explode(',', $inputLabels));

        $validatedLabels = null;
        foreach ($labelsId as $labelId){
            $label = Label::find($labelId);
            if (!empty($label) && $label instanceof $label){
                $validatedLabels[] = $labelId;

            }else{
                $task->destroy();
                return response(['message','Label id '.$labelId.' not found.'],404);
            }
        }



        $task->update();
        $task->labels()->sync($validatedLabels);

        $mail = [
            'body' => 'Task Status',
            'text'=> 'text',
            'url'=> 'url',
            'thankyou'=> 'thankyou'
        ];
        if ($task->status != $tasksRequest->input('status')){
            try {
                Notification::send($user,new TaskNotification($task));
            }catch (\Exception $e){
                Log::info('Cant send notification when changing task status');
            }
        }


        //Adding task labels to show.
        #LABELS Defined
        $labelsInfo = $this->getUserSingleTaskInfo($task);
        $task->LABELS = $labelsInfo;

        return new LabelsResource($task);
    }


    public function destroy($id)
    {
        $user = $this->jsonAuth();
        $task = Task::find($id);
        validateTask($task,$user->id);
        $task->destroy();

        return response(['message','Task Removed.'],204);

    }
}
