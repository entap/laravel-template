<?php

namespace Database\Factories;

use App\Models\LineNonce;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineNonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LineNonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nonce' => $this->faker->uuid,
        ];
    }
}
