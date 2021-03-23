<?php
namespace Tests\Feature\Auth\Providers;

use Tests\TestCase;
use App\Models\User;

class UserDeleteProviderTest extends TestCase
{
    public function test_認証連携を解除する()
    {
        $user = User::factory()->create();
        $user->saveProvider('twitter', 'xxx');

        $user->removeProvider('twitter');

        $this->assertDeleted('auth_providers', ['name' => 'twitter']);
    }
}
