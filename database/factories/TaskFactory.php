<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->randomElement(['code in php','go on jogging','read a book']),
            'description'=>$this->faker->randomElement(['coding in php','going on jogging','reading a book']),
            'status' => $this->faker->randomElement(['in-progress','not-started','completed']),
            'user_id'=>User::first()->id,
            'category_id'=>$this->faker->randomElement([1,2,3])
        ];
    }

}
