<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') === 'production') {
            $this->command->error('Production環境には適用できません。');
            die();
        }

        PackageRelease::truncate();
        Package::truncate();
        Package::factory(3)
            ->hasReleases(3)
            ->create();
    }
}
