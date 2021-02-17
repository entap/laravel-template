<?php

namespace Database\Factories;

use App\Models\UserSegment;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSegmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSegment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'filter' => [
                'email' => $this->faker->randomElement(),
            ],
        ];
    }
}
