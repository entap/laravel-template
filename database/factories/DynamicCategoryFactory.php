<?php

namespace Database\Factories;

use App\Models\DynamicCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class DynamicCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DynamicCategory::class;

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
