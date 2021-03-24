<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminDeletePackageTest extends TestCase
{
    use HasSuperUser;

    public function test_パッケージを削除する()
    {
        $package = Package::factory()
            ->hasReleases(1)
            ->create();

        $response = $this->actingAsSuperUser()->delete(
            route('admin.packages.destroy', $package)
        );

        $response
            ->assertRedirect(route('admin.packages.index'))
            ->assertSessionHas('success');

        $this->assertDeleted('packages', [
            'id' => $package->id,
        ]);

        foreach ($package->releases as $release) {
            $this->assertDeleted('package_releases', [
                'id' => $release->id,
            ]);
        }
    }
}
