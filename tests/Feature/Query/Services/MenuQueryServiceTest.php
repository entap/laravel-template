<?php
namespace Tests\Feature\Query\Services;

use App\Models\Admin\MenuItem;
use App\Query\Services\MenuQueryService;
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
        ]);
        $i2 = MenuItem::factory()->create([
            'uri' => '/admin/roles',
        ]);

        $this->assertEquals([$i1->id, $i2->id], $this->itemIds());
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
