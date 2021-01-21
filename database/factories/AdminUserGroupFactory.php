<?php

namespace Database\Factories;

use App\Models\AdminUserGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminUserGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminUserGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
        ];
    }
}
