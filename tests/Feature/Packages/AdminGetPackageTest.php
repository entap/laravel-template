<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminGetPackageTest extends TestCase
{
    use HasSuperUser;

    public function test_パッケージを表示できる()
    {
        $package = Package::factory()
            ->has(PackageRelease::factory(2), 'releases')
            ->create();

        $response = $this->actingAsSuperUser()->get(
            route('admin.packages.show', $package)
        );

        $response->assertOk()->assertSee($package->name);

        foreach ($package->releases as $release) {
            $response
                ->assertSee($release->version)
                ->assertSee($release->uri)
                ->assertSee($release->publish_date)
                ->assertSee($release->expire_date);
        }
    }

    public function test_リリースがない場合はフィードバックする()
    {
        $package = Package::factory()->create();

        $response = $this->actingAsSuperUser()->get(
            route('admin.packages.show', $package)
        );

        $response->assertOk()->assertSee(__('No Release'));
    }
}
