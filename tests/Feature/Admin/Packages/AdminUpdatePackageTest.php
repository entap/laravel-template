<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUpdatePackageTest extends TestCase
{
    public function test_編集フォームを表示する()
    {
        $package = Package::factory()->create();

        $this->get(route('admin.packages.edit', $package))
            ->assertOk()
            ->assertSee(__('Name'))
            ->assertSee(__('Update'));
    }

    public function test_パッケージを更新する()
    {
        $package = Package::factory()->create();
        $newPackage = Package::factory()->make();

        $response = $this->put(route('admin.packages.update', $package), [
            'name' => $newPackage->name,
        ]);

        $response->assertRedirect(route('admin.packages.show', $package));

        $this->assertDatabaseHas('packages', [
            'name' => $newPackage->name,
        ]);
    }
}
