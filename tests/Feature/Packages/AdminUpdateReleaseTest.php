<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminUpdateReleaseTest extends TestCase
{
    use HasSuperUser;

    public function test_編集フォームを表示する()
    {
        $response = $this->actingAsSuperUser()->get(
            route('admin.packages.releases.edit', [
                $this->package,
                $this->release,
            ])
        );
        $response->assertOk();
        // $response->assertSee(__('Version'));
        $response->assertSee($this->release->version);
        // $response->assertSee(__('URL'));
        $response->assertSee($this->release->uri);
        // $response->assertSee(__('Publish Date'));
        $response->assertSee($this->release->publish_date->format('Y-m-d H:i'));
        // $response->assertSee(__('Expire Date'));
        $response->assertSee($this->release->expire_date->format('Y-m-d H:i'));
        $response->assertSee(__('Update'));
    }

    public function test_リリースを更新する()
    {
        $response = $this->actingAsSuperUser()->updateRelease();

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'uri' => $this->newRelease->uri,
            'publish_date' => $this->newRelease->publish_date,
            'expire_date' => $this->newRelease->expire_date,
        ]);
    }

    public function test_バージョンは必須()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'version' => '',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('version');
    }

    public function test_バージョンはパッケージ内で重複禁止()
    {
        // 別のパッケージのリリースとは重複しても構わない
        $release = PackageRelease::factory()->create([
            'version' => $this->release->version,
        ]);

        $response = $this->actingAsSuperUser()->updateRelease([
            'version' => $release->version,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        // 同じパッケージのリリースとは重複できない
        $release = PackageRelease::factory()->create([
            'package_id' => $this->package->id,
        ]);

        $response = $this->actingAsSuperUser()->updateRelease([
            'version' => $release->version,
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('version');
    }

    public function test_自分自身とは重複しても構わない()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'version' => $this->release->version,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));
    }

    public function test_URLはURL形式のみ()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'uri' => 'helloworld',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_URLの長さは1000文字まで()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'uri' => "http://" . str_repeat("a", 996),
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_公開日は日付のみ()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'publish_date' => 'abcde',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('publish_date');
    }

    public function test_廃止日は日付のみ()
    {
        $response = $this->actingAsSuperUser()->updateRelease([
            'expire_date' => 'abcde',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('expire_date');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->package = Package::factory()->create();
        $this->release = PackageRelease::factory()->create([
            'package_id' => $this->package->id,
        ]);
        $this->newRelease = PackageRelease::factory()->make();
    }

    private function updateRelease($params = [])
    {
        return $this->put(
            route('admin.packages.releases.update', [
                $this->package,
                $this->release,
            ]),
            array_merge(
                [
                    'version' => $this->newRelease->version,
                    'uri' => $this->newRelease->uri,
                    'publish_date' => $this->newRelease->publish_date,
                    'expire_date' => $this->newRelease->expire_date,
                ],
                $params
            )
        );
    }
}
