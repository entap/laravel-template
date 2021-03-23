<?php
namespace Tests\Feature\Auth\Providers;

use Tests\TestCase;
use App\Models\User;

class UserGetUserWithProviderTest extends TestCase
{
    public function test_連携しているユーザーを取得する()
    {
        $user = User::factory()->create();
        $user->saveProvider('firebase', 'xxxx');

        $this->assertEquals(
            $user->id,
            User::withProvider('firebase', 'xxxx')->value('id')
        );
    }

    public function test_連携してないと取れない()
    {
        $user = User::factory()->create();
        $user->saveProvider('twitter', 'xxxx');

        $this->assertEquals(0, User::withProvider('firebase', 'xxxx')->count());
    }

    public function test_識別子が一致しないと取れない()
    {
        $user = User::factory()->create();
        $user->saveProvider('twitter', 'xxxx');

        $this->assertEquals(0, User::withProvider('twitter', 'xxx')->count());
    }
}
