<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDeleteMenuItemTest extends TestCase
{
    public function test_MenuItemを削除する()
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->deleteMenuItem($menuItem);

        $this->assertDeleted('admin_menu_items', [
            'id' => $menuItem->id,
        ]);

        $response->assertRedirect(route('admin.menu.items.index'));
    }

    private function deleteMenuItem($menuItem)
    {
        return $this->delete(route('admin.menu.items.destroy', $menuItem));
    }
}
