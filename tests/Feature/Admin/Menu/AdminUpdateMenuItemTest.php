<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUpdateMenuItemTest extends TestCase
{
    public function test_入力欄を表示する()
    {
        $item = MenuItem::factory()->create();

        $response = $this->get(route('admin.menu.items.edit', $item));

        $response->assertOk();
        $response->assertSee(__('Update'));
        $response->assertSee(__('Title'));
        $response->assertSee($item->title);
        $response->assertSee(__('URL'));
        $response->assertSee($item->uri);
        $response->assertSee(__('Order'));
        $response->assertSee($item->order);
    }

    public function test_MenuItemを更新する()
    {
        $item = MenuItem::factory()->create();
        $newMenuItem = MenuItem::factory()->make();

        $response = $this->saveMenuItem($item, [
            'title' => $newMenuItem->title,
        ]);

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
        ]);

        $response->assertRedirect(route('admin.menu.items.index'));
    }

    private function saveMenuItem($item, $params = [])
    {
        return $this->put(
            route('admin.menu.items.update', $item),
            array_merge([], $params)
        );
    }
}
