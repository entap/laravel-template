<?php
namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use App\Models\PackageRelease;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * ユーザーとして、パッケージごとのリリースを一覧できる
 */
class UserListReleasesTest extends TestCase
{
    public function test_リリースを一覧する()
    {
        $package = Package::factory()->create();
        $packageReleases = PackageRelease::factory(3)->create([
            'package_id' => $package->id,
        ]);

        $response = $this->actingAs(User::factory()->create(), 'api')->getJson(
            "/api/packages/{$package->id}/releases"
        );

        $response->assertOk();
        $response->assertJsonCount($packageReleases->count(), 'data');
    }

    public function test_無効になったリリースは出力しない()
    {
        $packageRelease = PackageRelease::factory()->create([
            'expire_date' => now(),
        ]);
        $package = $packageRelease->package;

        $response = $this->actingAs(User::factory()->create(), 'api')->getJson(
            "/api/packages/{$package->id}/releases"
        );

        $response->assertOk();
        $response->assertJsonCount(0, 'data');
    }

    public function test_公開されていないリリースは出力しない()
    {
        $packageRelease = PackageRelease::factory()->create([
            'publish_date' => now()->addMinute(),
        ]);
        $package = $packageRelease->package;

        $response = $this->actingAs(User::factory()->create(), 'api')->getJson(
            "/api/packages/{$package->id}/releases"
        );

        $response->assertOk();
        $response->assertJsonCount(0, 'data');
    }
}
