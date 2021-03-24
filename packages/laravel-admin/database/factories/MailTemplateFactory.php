<?php

namespace Database\Factories\Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\MailType;
use Entap\Admin\Database\Models\MailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mail_type_id' => MailType::factory(),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'from' => $this->faker->email,
            'to' => $this->faker->email,
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'status' => 'available',
            'starts_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
