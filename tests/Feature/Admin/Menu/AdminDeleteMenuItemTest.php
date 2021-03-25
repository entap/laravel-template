<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\Admin\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\WithAdministrator;

class AdminDeleteMenuItemTest extends TestCase
{
    use WithAdministrator;

    public function test_MenuItemを削除する()
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->deleteMenuItem($menuItem);

        $this->assertDeleted('admin_menu_items', [
            'id' => $menuItem->id,
        ]);

        $response->assertRedirect(route('admin.settings.menu.items.index'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function deleteMenuItem($menuItem)
    {
        return $this->delete(
            route('admin.settings.menu.items.destroy', $menuItem)
        );
    }
}
