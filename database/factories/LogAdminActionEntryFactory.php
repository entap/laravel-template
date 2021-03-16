<?php

namespace Database\Factories;

use App\Models\LogAdminActionEntry;
use Entap\Admin\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogAdminActionEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogAdminActionEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_user_id' => User::factory(),
            'action' => $this->faker->colorName,
            'note' => $this->faker->sentence(),
        ];
    }
}
