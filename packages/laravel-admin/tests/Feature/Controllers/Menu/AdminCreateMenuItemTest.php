<?php

namespace Tests\Feature\Controllers\Menu;

use Tests\TestCase;
use Entap\Admin\Database\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCreateMenuItemTest extends TestCase
{
    public function test_入力欄を表示する()
    {
        $response = $this->get(route('admin.settings.menu.items.create'));
        $response->assertOk();
        $response->assertSee('Create');
        // $response->assertSee('Title');
        // $response->assertSee('URL');
        // $response->assertSee('Order');
        // $response->assertSee('Parent');
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

        $response->assertRedirect(route('admin.settings.menu.items.index'));
    }

    public function test_titleは必須()
    {
        $response = $this->saveMenuItem(['title' => '']);
        $response
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('title');
    }

    public function test_任意入力項目を設定できる()
    {
        $newMenuItem = MenuItem::factory()->make();

        $response = $this->saveMenuItem(
            $newMenuItem->only('title', 'uri', 'order')
        );

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
            'order' => $newMenuItem->order,
        ]);

        $response->assertRedirect(route('admin.settings.menu.items.index'));
    }

    private function saveMenuItem($params = [])
    {
        return $this->post(
            route('admin.settings.menu.items.store'),
            array_merge([], $params)
        );
    }
}
