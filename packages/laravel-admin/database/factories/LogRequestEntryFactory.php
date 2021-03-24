<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\LogRequestEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogRequestEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogRequestEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'host' => $this->faker->uuid,
            'method' => $this->faker->randomElement(['get', 'post']),
            'action' => $this->faker->url,
            'status' => $this->faker->randomNumber(),
            'request_body' => $this->faker->paragraph,
            'response_body' => $this->faker->paragraph,
            'user_id' => $this->faker->randomNumber(),
            'device' => $this->faker->uuid,
            'device_brand' => $this->faker->uuid,
            'platform' => $this->faker->uuid,
            'platform_version' => $this->faker->uuid,
            'package_name' => $this->faker->uuid,
            'package_version' => $this->faker->uuid,
        ];
    }
}
