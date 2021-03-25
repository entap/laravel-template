<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\Admin\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\WithAdministrator;

class AdminListMenuItemTest extends TestCase
{
    use WithAdministrator;

    public function test_一覧を表示する()
    {
        $items = MenuItem::factory(2)->create();

        $response = $this->get(route('admin.settings.menu.items.index'));

        $response->assertOk();
        foreach ($items as $item) {
            $response->assertSee($item->title);
            $response->assertSee($item->uri);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }
}
