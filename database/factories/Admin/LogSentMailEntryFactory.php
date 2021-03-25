<?php

namespace Database\Factories\Admin;

use App\Models\Admin\LogSentMailEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogSentMailEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogSentMailEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'to' => $this->faker->safeEmail,
            'from' => $this->faker->safeEmail,
            'subject' => $this->faker->paragraph(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
