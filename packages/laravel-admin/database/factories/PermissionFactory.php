<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
  protected $model = Permission::class;

  public function definition()
  {
    return [
      'name' => $this->faker->uuid,
    ];
  }
}
