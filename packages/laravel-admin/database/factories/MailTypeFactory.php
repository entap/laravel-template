<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\MailType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->uuid,
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
