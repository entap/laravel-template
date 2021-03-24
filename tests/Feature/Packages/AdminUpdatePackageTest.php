<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminUpdatePackageTest extends TestCase
{
    use HasSuperUser;

    public function test_編集フォームを表示する()
    {
        $response = $this->actingAsSuperUser()->get(route('admin.packages.edit', $this->package));

        $response->assertOk();
        // $response->assertSee(__('Name'));
        $response->assertSee(__('Update'));
    }

    public function test_パッケージを更新する()
    {
        $newPackage = Package::factory()->make();

        $response = $this->actingAsSuperUser()->updatePackage([
            'name' => $newPackage->name,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('packages', [
            'name' => $newPackage->name,
        ]);
    }

    public function test_名前は必須()
    {
        $response = $this->actingAsSuperUser()->updatePackage([
            'name' => '',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_名前は重複禁止()
    {
        $otherPackage = Package::factory()->create();

        $response = $this->actingAsSuperUser()->updatePackage([
            'name' => $otherPackage->name,
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_元の名前とは重複してもよい()
    {
        $response = $this->actingAsSuperUser()->updatePackage([
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
