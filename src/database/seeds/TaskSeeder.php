<?php
namespace Hjolfaei\Todo\database\seeds;
//namespace Database\Seeds;

use Hjolfaei\Todo\Models\Task;
use Illuminate\Database\Seeder;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class,5)->create();

    }
}
