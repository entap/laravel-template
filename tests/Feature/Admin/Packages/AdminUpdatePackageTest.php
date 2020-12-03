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
        $this->get(route('admin.packages.edit', $this->package))
            ->assertOk()
            ->assertSee(__('Name'))
            ->assertSee(__('Update'));
    }

    public function test_パッケージを更新する()
    {
        $newPackage = Package::factory()->make();

        $response = $this->updatePackage([
            'name' => $newPackage->name,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('packages', [
            'name' => $newPackage->name,
        ]);
    }

    public function test_名前は必須()
    {
        $response = $this->updatePackage([
            'name' => '',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_名前は重複禁止()
    {
        $otherPackage = Package::factory()->create();

        $response = $this->updatePackage([
            'name' => $otherPackage->name,
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_元の名前とは重複してもよい()
    {
        $response = $this->updatePackage([
            'name' => $this->package->name,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->package = Package::factory()->create();
    }

    private function updatePackage($params)
    {
        return $this->put(
            route('admin.packages.update', $this->package),
            $params
        );
    }
}
