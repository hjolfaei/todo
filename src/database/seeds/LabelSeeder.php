<?php
namespace Hjolfaei\Todo\database\seeds;
//namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Hjolfaei\Todo\Models\Label;;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Label::class,5)->create();
    }
}
