<?php
namespace Tests\Feature\Auth\Providers;

use Tests\TestCase;
use App\Models\User;
use InvalidArgumentException;

class UserCreateProviderTest extends TestCase
{
    public function test_認証連携を登録する()
    {
        $user = User::factory()->create();

        $user->saveProvider('firebase', 'xxx');
        // 何度送っても同じ
        $user->saveProvider('firebase', 'xxx');

        $this->assertDatabaseHas('auth_providers', [
            'user_id' => $user->id,
            'name' => 'firebase',
            'code' => 'xxx',
        ]);
    }

    public function test_他のユーザーが使っているアカウントとは連携できない()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $other->saveProvider('firebase', 'xxx');

        $this->expectException(InvalidArgumentException::class);

        $user->saveProvider('firebase', 'xxx');
    }
}
