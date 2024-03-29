<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserOpinion;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserOpinionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserOpinion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
