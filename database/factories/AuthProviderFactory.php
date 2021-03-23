<?php

namespace Database\Factories;

use Entap\Auth\Models\AuthProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AuthProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->uuid,
            'code' => $this->faker->uuid,
        ];
    }
}
