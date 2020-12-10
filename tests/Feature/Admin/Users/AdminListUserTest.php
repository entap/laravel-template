<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * 管理者として、利用者を一覧できる
 * @group users
 */
class AdminListUserTest extends TestCase
{
    public function test_一覧を表示する()
    {
        $items = User::factory(2)->create();

        $response = $this->get(route('admin.app.users.index'));

        $response->assertOk();
        foreach ($items as $item) {
            $response->assertSee($item->name);
            $response->assertSee($item->email);
        }
    }

    public function test_データがない場合はそれを表示する()
    {
        $response = $this->get(route('admin.app.users.index'));

        $response->assertOk();
        $response->assertSee(__('No User'));
    }

    public function test_名前で絞り込む()
    {
        $user1 = User::factory()->create(['name' => '佐藤かずま']);
        $user2 = User::factory()->create(['name' => 'めぐみん']);

        $response = $this->get(
            route('admin.app.users.index', ['name' => 'かず'])
        );

        $response
            ->assertOk()
            ->assertViewHas('users', function ($users) use ($user1) {
                return $users->contains('id', $user1->id);
            })
            ->assertViewHas('users', function ($users) use ($user2) {
                return !$users->contains('id', $user2->id);
            });
    }
}
