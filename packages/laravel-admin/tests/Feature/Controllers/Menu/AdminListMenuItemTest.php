<?php

namespace Tests\Feature\Controllers\Menu;

use Tests\TestCase;
use Entap\Admin\Database\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminListMenuItemTest extends TestCase
{
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
}
