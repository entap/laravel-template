<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\Admin\MenuItem;
use Tests\Support\WithAdministrator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCreateMenuItemTest extends TestCase
{
    use WithAdministrator;

    public function test_入力欄を表示する()
    {
        $response = $this->get(route('admin.settings.menu.items.create'));
        $response->assertOk();
        $response->assertSee(__('Create'));
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
            $newMenuItem->only('title', 'uri')
        );

        $this->assertDatabaseHas('admin_menu_items', [
            'title' => $newMenuItem->title,
            'uri' => $newMenuItem->uri,
        ]);

        $response->assertRedirect(route('admin.settings.menu.items.index'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function saveMenuItem($params = [])
    {
        return $this->post(
            route('admin.settings.menu.items.store'),
            array_merge([], $params)
        );
    }
}
