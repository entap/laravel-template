<?php
namespace Tests\Feature\Query\Services;

use Tests\TestCase;
use Entap\Admin\Database\Models\UserGroup;
use Entap\Admin\Application\Query\Service\UserGroupQueryService;

/**
 * ユーザーグループの検索サービスのテスト
 */
class UserGroupQueryServiceTest extends TestCase
{
    public function test_ユーザーグループを取得する()
    {
        $groups = UserGroup::factory(3)->create();

        $this->assertEquals($groups->count(), $this->service->query()->count());
    }

    public function test_名前の完全一致で絞り込む()
    {
        UserGroup::create(['name' => 'ii masamits']);
        UserGroup::create(['name' => '*ii masamits*']);

        $groups = $this->service->query(['name' => 'ii masamits'])->count();

        $this->assertEquals(1, $groups);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new UserGroupQueryService();
    }
}
