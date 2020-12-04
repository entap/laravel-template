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
            'uri' => null,
            'publish_date' => '0000-01-01 00:00:00',
            'expire_date' => '9999-12-31 23:59:59',
        ]);
    }

    public function test_URLを設定できる()
    {
        $response = $this->createRelease([
            'uri' => $this->newRelease->uri,
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'uri' => $this->newRelease->uri,
        ]);
    }

    public function test_公開日を設定できる()
    {
        $response = $this->createRelease([
            'publish_date' => '2020-12-04 20:00',
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'publish_date' => '2020-12-04 20:00:00',
        ]);
    }

    public function test_廃止日を公開できる()
    {
        $response = $this->createRelease([
            'expire_date' => '2021-05-24 12:30',
        ]);

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'expire_date' => '2021-05-24 12:30:00',
        ]);
    }

    public function test_バージョンは必須()
    {
        $response = $this->createRelease([
            'version' => '',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('version');
    }

    public function test_URLはURL形式のみ()
    {
        $response = $this->createRelease([
            'uri' => 'helloworld',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_URLの長さは1000文字まで()
    {
        $response = $this->createRelease([
            'uri' => "http://" . str_repeat("a", 996),
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_公開日は日付のみ()
    {
        $response = $this->createRelease([
            'publish_date' => 'abcde',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('publish_date');
    }

    public function test_廃止日は日付のみ()
    {
        $response = $this->createRelease([
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
        $this->newRelease = PackageRelease::factory()->make();
    }

    private function createRelease($params = [])
    {
        return $this->post(
            route('admin.packages.releases.store', $this->package),
            array_merge(
                [
                    'version' => $this->newRelease->version,
                    'uri' => '',
                    'publish_date' => '',
                    'expire_date' => '',
                ],
                $params
            )
        );
    }
}
