<?php

namespace Tests\Feature\Admin\Menu;

use Tests\TestCase;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminListMenuItemTest extends TestCase
{
    public function test_一覧を表示する()
    {
        $items = MenuItem::factory(2)->create();

        $response = $this->get(route('admin.menu.items.index'));

        $response->assertOk();
        foreach ($items as $item) {
            $response->assertSee($item->title);
            $response->assertSee($item->uri);
        }
    }
}
