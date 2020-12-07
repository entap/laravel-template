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
        $newMenuItem = MenuItem::factory()->make();

        $response = $this->saveMenuItem([
            'title' => $newMenuItem->title,
        ]);

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
        ]);

        $response->assertRedirect(route('admin.menu.items.index'));
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

        $response = $this->saveMenuItem([
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
            'order' => $newMenuItem->order,
        ]);

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
            'order' => $newMenuItem->order,
        ]);

        $response->assertRedirect(route('admin.menu.items.index'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->item = MenuItem::factory()->create();
    }

    private function saveMenuItem($params = [])
    {
        return $this->put(
            route('admin.menu.items.update', $this->item),
            array_merge([], $params)
        );
    }
}
