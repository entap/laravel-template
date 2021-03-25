<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\Admin\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\WithAdministrator;

class AdminUpdateMenuItemTest extends TestCase
{
    use WithAdministrator;

    public function test_入力欄を表示する()
    {
        $item = MenuItem::factory()->create();

        $response = $this->get(route('admin.settings.menu.items.edit', $item));

        $response->assertOk();
        $response->assertSee(__('Update'));
        // $response->assertSee(__('Title'));
        $response->assertSee($item->title);
        // $response->assertSee(__('URL'));
        $response->assertSee($item->uri);
    }

    public function test_MenuItemを更新する()
    {
        $newMenuItem = MenuItem::factory()->make();

        $response = $this->saveMenuItem([
            'title' => $newMenuItem->title,
        ]);

        $this->assertDatabaseHas('admin_menu_items', [
            'id' => $this->item->id,
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

        $response = $this->saveMenuItem([
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
        ]);

        $response->assertRedirect(route('admin.settings.menu.items.index'));

        $this->assertDatabaseHas('admin_menu_items', [
            'id' => $this->item->id,
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->item = MenuItem::factory()->create();
        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function saveMenuItem($params = [])
    {
        return $this->put(
            route('admin.settings.menu.items.update', $this->item),
            array_merge([], $params)
        );
    }
}
