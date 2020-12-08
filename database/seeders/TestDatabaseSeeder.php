<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Entap\ClientPackager\Models\Package;
use Entap\Admin\Database\Models\MenuItem;
use Entap\ClientPackager\Models\PackageRelease;

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

        MenuItem::create([
            'title' => 'クライアントパッケージ',
            'uri' => route('admin.packages.index', null, false),
        ]);

        PackageRelease::truncate();
        Package::truncate();
        Package::factory(3)
            ->hasReleases(3)
            ->create();
    }
}
