<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDeletePackageTest extends TestCase
{
    public function test_パッケージを削除する()
    {
        $package = Package::factory()
            ->hasReleases(1)
            ->create();

        $response = $this->delete(route('admin.packages.destroy', $package));

        // TODO flash出してもいいかも
        $response->assertRedirect(route('admin.packages.index'));

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
