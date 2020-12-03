<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminGetPackageTest extends TestCase
{
    public function test_パッケージを表示できる()
    {
        $package = Package::factory()
            ->has(PackageRelease::factory(2), 'releases')
            ->create();

        $response = $this->get(route('admin.packages.show', $package));

        $response->assertOk()->assertSee($package->name);

        foreach ($package->releases as $release) {
            $response
                ->assertSee($release->version)
                ->assertSee($release->uri)
                ->assertSee($release->publish_date)
                ->assertSee($release->expire_date);
        }
    }
}
