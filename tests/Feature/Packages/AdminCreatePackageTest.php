<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminCreatePackageTest extends TestCase
{
    use HasSuperUser;

    public function test_パッケージの登録フォームを表示する()
    {
        $response = $this->actingAsSuperUser()->get(
            route('admin.packages.create')
        );

        $response->assertOk();
        // $response->assertSee(__('Name'));
        $response->assertSee(__('Create'));
    }

    public function test_パッケージを追加する()
    {
        $newPackage = Package::factory()->make();

        $response = $this->actingAsSuperUser()->post(
            route('admin.packages.store'),
            [
                'name' => $newPackage->name,
            ]
        );

        $response->assertRedirect(route('admin.packages.index'));

        $this->assertDatabaseHas('packages', [
            'name' => $newPackage->name,
        ]);
    }

    public function test_名前は必須()
    {
        $response = $this->actingAsSuperUser()->post(
            route('admin.packages.store'),
            [
                'name' => '',
            ]
        );

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_名前は重複禁止()
    {
        $package = Package::factory()->create();

        $response = $this->actingAsSuperUser()->post(
            route('admin.packages.store'),
            [
                'name' => $package->name,
            ]
        );

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }
}
