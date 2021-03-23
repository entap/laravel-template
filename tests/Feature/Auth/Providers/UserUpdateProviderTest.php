<?php
namespace Tests\Feature\Auth\Providers;

use Tests\TestCase;
use App\Models\User;

class UserUpdateProviderTest extends TestCase
{
    public function test_認証連携を変更する()
    {
        $user = User::factory()->create();
        $user->saveProvider('firebase', 'xxx');

        $user->saveProvider('firebase', 'yyy');

        $this->assertDatabaseHas('auth_providers', [
            'name' => 'firebase',
            'code' => 'yyy',
        ]);
        $this->assertDatabaseMissing('auth_providers', [
            'name' => 'firebase',
            'code' => 'xxx',
        ]);
    }
}
