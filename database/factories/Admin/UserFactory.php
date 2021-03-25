<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => Str::random(20),
            'password' =>
                '$2y$10$m5Fonp1AeVfipTBLvXCxUuxuM4vQnyLvC8tt3ckYHHBbys7qKm6EK', // "password"
        ];
    }
}
