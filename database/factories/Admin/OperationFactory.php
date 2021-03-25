<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    protected $model = Operation::class;

    public function definition()
    {
        return [
            'method' => $this->faker->randomElement(['get', 'post', 'head']),
            'action' => $this->faker->url,
        ];
    }
}
