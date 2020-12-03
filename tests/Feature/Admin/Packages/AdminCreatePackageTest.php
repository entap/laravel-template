<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCreatePackageTest extends TestCase
{
    public function test_パッケージの登録フォームを表示する()
    {
        $this->get(route('admin.packages.create'))
            ->assertOk()
            ->assertSee(__('Name'))
            ->assertSee(__('Create'));
    }

    public function test_パッケージを追加する()
    {
        $newPackage = Package::factory()->make();

        $response = $this->post(route('admin.packages.store'), [
            'name' => $newPackage->name,
        ]);

        $response->assertRedirect(route('admin.packages.index'));

        $this->assertDatabaseHas('packages', [
            'name' => $newPackage->name,
        ]);
    }
}
