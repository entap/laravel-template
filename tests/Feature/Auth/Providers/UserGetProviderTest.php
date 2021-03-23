<?php
namespace Tests\Feature\Auth\Providers;

use Tests\TestCase;
use App\Models\User;

class UserGetProviderTest extends TestCase
{
    public function test_認証連携を取得する()
    {
        $user = User::factory()->create();
        $user->saveProvider('facebook', 'xxxxx');

        $provider = $user->getProvider('facebook');

        $this->assertEquals('facebook', $provider->name);
        $this->assertEquals('xxxxx', $provider->code);
    }

    public function test_連携してない場合は取得しない()
    {
        $user = User::factory()->create();
        $user->saveProvider('twitter', 'xxxxx');

        $provider = $user->getProvider('facebook');

        $this->assertNull($provider);
    }
}
