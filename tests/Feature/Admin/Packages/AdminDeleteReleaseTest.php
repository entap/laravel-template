<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDeleteReleaseTest extends TestCase
{
    public function test_リリースを削除する()
    {
        $package = Package::factory()->create();
        $release = PackageRelease::factory()->create([
            'package_id' => $package->id,
        ]);

        $response = $this->delete(
            route('admin.packages.releases.destroy', [$package, $release])
        );

        $response->assertRedirect(route('admin.packages.show', $package));

        $this->assertDeleted('package_releases', [
            'id' => $release->id,
        ]);
    }
}
