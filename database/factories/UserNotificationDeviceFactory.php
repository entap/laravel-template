<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserNotificationDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserNotificationDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserNotificationDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'token' => $this->faker->uuid,
        ];
    }
}
