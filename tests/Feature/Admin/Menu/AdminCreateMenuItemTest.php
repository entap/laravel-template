<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCreateMenuItemTest extends TestCase
{
    public function test_入力欄を表示する()
    {
        $response = $this->get(route('admin.menu.items.create'));
        $response->assertOk();
        $response->assertSee(__('Create'));
        $response->assertSee(__('Title'));
        $response->assertSee(__('URL'));
        $response->assertSee(__('Order'));
    }

    public function test_MenuItemを追加する()
    {
        $newMenuItem = MenuItem::factory()->make();

        $response = $this->saveMenuItem([
            'title' => $newMenuItem->title,
        ]);

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
        ]);

        $response->assertRedirect(route('admin.menu.items.index'));
    }

    private function saveMenuItem($params = [])
    {
        return $this->post(
            route('admin.menu.items.store'),
            array_merge([], $params)
        );
    }
}
