<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;
use App\Models\User;
use Tests\Support\HasSuperUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * 管理者として、利用者を一覧できる
 * @group users
 */
class AdminListUserTest extends TestCase
{
    use HasSuperUser;

    public function test_一覧を表示する()
    {
        $items = User::factory(2)->create();

        $response = $this->listUsers();

        $response->assertOk();
        foreach ($items as $item) {
            $response->assertSee($item->name);
            $response->assertSee($item->email);
        }
    }

    public function test_データがない場合はそれを表示する()
    {
        $response = $this->listUsers();

        $response->assertOk();
        $response->assertSee(__('No User'));
    }

    public function test_名前で絞り込む()
    {
        $user1 = User::factory()->create(['name' => '佐藤かずま']);
        $user2 = User::factory()->create(['name' => 'めぐみん']);

        // 部分一致
        $response = $this->listUsers(['name' => 'かず']);

        $response
            ->assertOk()
            ->assertViewHas('users', function ($users) use ($user1) {
                return $users->contains('id', $user1->id);
            })
            ->assertViewHas('users', function ($users) use ($user2) {
                return !$users->contains('id', $user2->id);
            });
    }

    public function test_メールアドレスで絞り込む()
    {
        $user1 = User::factory()->create(['email' => 'kazuma.sato@gmail.com']);
        $user2 = User::factory()->create(['email' => 'meg.min@gmail.com']);

        // 部分一致
        $response = $this->listUsers(['email' => 'min']);

        $response
            ->assertOk()
            ->assertViewHas('users', function ($users) use ($user1) {
                return !$users->contains('id', $user1->id);
            })
            ->assertViewHas('users', function ($users) use ($user2) {
                return $users->contains('id', $user2->id);
            });
    }

    public function test_登録日の始点で絞り込む()
    {
        $user1 = User::factory()->create();
        $this->travel(1)->seconds();
        $user2 = User::factory()->create();

        $response = $this->listUsers([
            'start_created_at' => now()->format('c'),
        ]);

        $response
            ->assertOk()
            ->assertViewHas('users', function ($users) use ($user1) {
                return !$users->contains('id', $user1->id);
            })
            ->assertViewHas('users', function ($users) use ($user2) {
                return $users->contains('id', $user2->id);
            });
    }

    public function test_登録日の終点で絞り込む()
    {
        $user1 = User::factory()->create();
        $this->travel(1)->seconds();
        $user2 = User::factory()->create();

        $response = $this->listUsers([
            'end_created_at' => now()->format('c'),
        ]);

        $response
            ->assertOk()
            ->assertViewHas('users', function ($users) use ($user1) {
                return $users->contains('id', $user1->id);
            })
            ->assertViewHas('users', function ($users) use ($user2) {
                return !$users->contains('id', $user2->id);
            });
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAsSuperUser();
    }

    private function listUsers($params = [])
    {
        return $this->get(route('admin.users.index', $params));
    }
}
