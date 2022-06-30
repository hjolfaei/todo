<?php

namespace Hjolfaei\Todo\Http\Controllers;

use Hjolfaei\Todo\database\seeds\DatabaseSeeder;
use Hjolfaei\Todo\database\seeds\LabelSeeder;
use Hjolfaei\Todo\database\seeds\TaskSeeder;
use Hjolfaei\Todo\database\seeds\TaskLabelSeeder;
use App\Http\Controllers\Controller;


;

class TodoController extends Controller
{
    public function index()
    {
        return view('hjolfaei::index');
    }

    public function fill()
    {
        try {
            //$this->call(TaskSeeder::class);
            //$this->call(LabelSeeder::class);
            $taskSeeder = new TaskSeeder();
            $taskSeeder->run();
            $labelSeeder = new LabelSeeder();
            $labelSeeder->run();
            $labelTaskSeeder = new TaskLabelSeeder();
            $labelTaskSeeder->run();
        }catch (\Exception $e){
            return response()->json(['message' => 'Something wrong.cant fill test data.'],500);
        }
        return response()->json(['message' => 'Test data filled successfully.'],200);
    }



}
