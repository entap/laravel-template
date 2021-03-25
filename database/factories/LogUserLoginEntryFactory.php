<?php

namespace Database\Factories;

use App\Models\LogUserLoginEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogUserLoginEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogUserLoginEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'user_email' => $this->faker->safeEmail,
            'auth_type' => $this->faker->sentence,
        ];
    }
}
