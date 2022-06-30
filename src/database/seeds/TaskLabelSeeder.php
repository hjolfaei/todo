<?php
namespace Hjolfaei\Todo\database\seeds;
//namespace Database\Seeds;

use Hjolfaei\Todo\Models\TaskLabel;
use Illuminate\Database\Seeder;

class TaskLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TaskLabel::class,8)->create();
    }
}
