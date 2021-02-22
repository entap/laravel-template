<?php

namespace Database\Factories;

use App\Models\DynamicContent;
use App\Models\DynamicPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class DynamicContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DynamicContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dynamic_page_id' => DynamicPage::factory(),
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->randomHtml(),
        ];
    }
}
