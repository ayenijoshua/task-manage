<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory(1)->create();
        Category::factory()->create(['name'=>'family']);
        Category::factory()->create(['name'=>'personal']);
        Category::factory()->create(['name'=>'work']);
        \App\Models\Task::factory()->create(['category_id'=>1]);
        \App\Models\Task::factory()->create(['category_id'=>2]);
        \App\Models\Task::factory()->create(['category_id'=>3]);
    }
}
