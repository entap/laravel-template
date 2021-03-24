<?php
namespace Tests\Feature\Query\Services;

use Entap\Admin\Database\Models\MenuItem;
use Entap\Admin\Application\Query\Service\MenuQueryService;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

class MenuQueryServiceTest extends TestCase
{
    use WithAdministrator;

    public function test_any権限を持っていると全てのメニューを取得する()
    {
        $this->userHasOperation('*', '*');
        $i1 = MenuItem::factory()->create([
            'uri' => '/admin/users',
            'order' => 10,
        ]);
        $i2 = MenuItem::factory()->create([
            'uri' => '/admin/roles',
            'order' => 1,
        ]);

        // orderの若い順に並ぶ
        $this->assertEquals([$i2->id, $i1->id], $this->itemIds());
    }

    public function test_許可されていない項目を取得しない()
    {
        $this->userHasOperation('*', 'admin/roles');

        $i1 = MenuItem::factory()->create(['uri' => '/admin/roles']);
        $i2 = MenuItem::factory()->create(['uri' => '/admin/packages']);
        $i3 = MenuItem::factory()->create(['uri' => '/']);

        $itemIds = $this->itemIds();

        $this->assertContains($i1->id, $itemIds);
        $this->assertNotContains($i2->id, $itemIds);
        $this->assertNotContains($i3->id, $itemIds);
    }

    public function test_ルートに対応できる()
    {
        $this->userHasOperation('*', '/');

        $item = MenuItem::factory()->create(['uri' => '/']);

        $this->assertContains($item->id, $this->itemIds());
    }

    public function test_uriがなければ無条件で取得する()
    {
        $item = MenuItem::factory()->create(['uri' => '']);

        $this->assertContains($item->id, $this->itemIds());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userCreated();
    }

    private function items()
    {
        return (new MenuQueryService())->items($this->currentUser);
    }

    private function itemIds()
    {
        return $this->items()
            ->pluck('id')
            ->toArray();
    }
}
