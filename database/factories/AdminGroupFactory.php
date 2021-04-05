<?php

namespace Database\Factories;

use App\Models\AdminGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
        ];
    }
}
