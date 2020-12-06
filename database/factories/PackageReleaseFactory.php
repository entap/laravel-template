<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageReleaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PackageRelease::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'package_id' => Package::factory(),
            'version' => $this->fakeVersion(),
            'uri' => $this->faker->url,
            'publish_date' => new Carbon('0001-01-01 00:00:00'),
            'expire_date' => new Carbon("9999-12-31 23:59:59"),
        ];
    }

    private function fakeVersion()
    {
        return "{$this->faker->randomNumber()}.{$this->faker->randomNumber()}.{$this->faker->randomNumber()}";
    }
}
