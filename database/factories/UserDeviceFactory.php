<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'uuid' => Str::uuid(),
            'platform' => $this->faker->word,
            'screen_width' => $this->faker->randomNumber(3),
            'screen_height' => $this->faker->randomNumber(3),
        ];
    }
}
