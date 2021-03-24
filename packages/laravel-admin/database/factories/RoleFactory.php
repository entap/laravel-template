<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
  protected $model = Role::class;

  public function definition()
  {
    return [
      'name' => $this->faker->uuid,
    ];
  }
}
