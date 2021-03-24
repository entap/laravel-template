<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminDeleteReleaseTest extends TestCase
{
    use HasSuperUser;

    public function test_リリースを削除する()
    {
        $package = Package::factory()->create();
        $release = PackageRelease::factory()->create([
            'package_id' => $package->id,
        ]);

        $response = $this->actingAsSuperUser()->delete(
            route('admin.packages.releases.destroy', [$package, $release])
        );

        $response->assertRedirect(route('admin.packages.show', $package));

        $this->assertDeleted('package_releases', [
            'id' => $release->id,
        ]);
    }
}
