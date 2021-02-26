<?php

namespace Database\Factories;

use App\Models\AgreementType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgreementTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgreementType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            'name' => $this->faker->sentence(),
        ];
    }
}
