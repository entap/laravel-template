<?php

namespace Database\Factories;

use App\Models\Agreement;
use App\Models\AgreementType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agreement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agreement_type_id' => AgreementType::factory(),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
