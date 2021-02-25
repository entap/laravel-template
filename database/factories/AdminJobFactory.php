<?php

namespace Database\Factories;

use App\Models\AdminJob;
use Entap\Admin\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminJobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminJob::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
        ];
    }
}
