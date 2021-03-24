<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\Operation;
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
