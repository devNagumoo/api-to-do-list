<?php

namespace Database\Factories;

use App\Model;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
    	return [
    	   'tarefa' => $this->faker->name(),
           'data_vencimento' => $this->faker->dateTime()
    	];
    }
}
