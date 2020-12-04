<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCreateReleaseTest extends TestCase
{
    public function test_リリースの登録フォームを表示する()
    {
        $this->get(route('admin.packages.releases.create', $this->package))
            ->assertOk()
            ->assertSee(__('Version'))
            ->assertSee(__('URL'))
            ->assertSee(__('Publish Date'))
            ->assertSee(__('Expire Date'))
            ->assertSee(__('Create'));
    }

    public function test_リリースを追加する()
    {
        $response = $this->createRelease();

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'uri' => $this->newRelease->uri,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->package = Package::factory()->create();
        $this->newRelease = PackageRelease::factory()->make();
    }

    private function createRelease($params = [])
    {
        return $this->post(
            route('admin.packages.releases.store', $this->package),
            array_merge(
                [
                    'version' => $this->newRelease->version,
                    'uri' => $this->newRelease->uri,
                ],
                $params
            )
        );
    }
}
