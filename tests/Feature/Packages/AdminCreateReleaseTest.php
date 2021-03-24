<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminCreateReleaseTest extends TestCase
{
    use HasSuperUser;

    public function test_リリースの登録フォームを表示する()
    {
        $response = $this->actingAsSuperUser()->get(
            route('admin.packages.releases.create', $this->package)
        );

        $response->assertOk();
        // $response->assertSee(__('Version'));
        // $response->assertSee(__('URL'));
        // $response->assertSee(__('Publish Date'));
        // $response->assertSee(__('Expire Date'));
        $response->assertSee(__('Create'));
    }

    public function test_リリースを追加する()
    {
        $response = $this->actingAsSuperUser()->createRelease();

        $response->assertRedirect(route('admin.packages.show', $this->package));

        $this->assertDatabaseHas('package_releases', [
            'version' => $this->newRelease->version,
            'uri' => null,
            'publish_date' => '0001-01-01 00:00:00',
            'expire_date' => '9999-12-31 23:59:59',
        ]);
    }

    public function test_URLを設定できる()
    {
        $response = $this->actingAsSuperUser()->createRelease([
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
        $response = $this->actingAsSuperUser()->createRelease([
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
        $response = $this->actingAsSuperUser()->createRelease([
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
        $response = $this->actingAsSuperUser()->createRelease([
            'version' => '',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('version');
    }

    public function test_バージョンはパッケージ内で重複禁止()
    {
        // パッケージ内では重複禁止
        $release = PackageRelease::factory()->create([
            'package_id' => $this->package->id,
        ]);

        $response = $this->actingAsSuperUser()->createRelease([
            'version' => $release->version,
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('version');

        // 別のパッケージのリリースとは重複しても構わない
        $otherPackage = Package::factory()->create();
        $otherPackage->releases()->save($release);

        $res2 = $this->createRelease([
            'version' => $release->version,
        ]);

        $res2->assertSessionHasNoErrors();
    }

    public function test_URLはURL形式のみ()
    {
        $response = $this->actingAsSuperUser()->createRelease([
            'uri' => 'helloworld',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_URLの長さは1000文字まで()
    {
        $response = $this->actingAsSuperUser()->createRelease([
            'uri' => "http://" . str_repeat("a", 996),
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('uri');
    }

    public function test_公開日は日付のみ()
    {
        $response = $this->actingAsSuperUser()->createRelease([
            'publish_date' => 'abcde',
        ]);

        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('publish_date');
    }

    public function test_廃止日は日付のみ()
    {
        $response = $this->actingAsSuperUser()->createRelease([
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
