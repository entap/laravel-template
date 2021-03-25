<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Permission;
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
