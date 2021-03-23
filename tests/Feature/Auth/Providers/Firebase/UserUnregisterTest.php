<?php
namespace Tests\Feature\Auth\Providers\Firebase;

use Tests\TestCase;
use App\Models\User;

class UserUnregisterTest extends TestCase
{
    public function test_認証連携を解除する()
    {
        $user = User::factory()->create();
        $user->saveProvider('firebase', 'xxx');

        $this->actingAs($user, 'api');
        $response = $this->unregister();

        $response->assertSuccessful();

        $this->assertDeleted('auth_providers', [
            'user_id' => $user->id,
            'name' => 'firebase',
        ]);
    }

    public function test_ログインしてないと失敗する()
    {
        $response = $this->json('delete', '/api/auth/firebase/user');

        $response->assertUnauthorized();
    }

    public function test_連携してなくても成功する()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');
        $response = $this->unregister();

        $response->assertSuccessful();
    }

    private function unregister()
    {
        return $this->json('delete', '/api/auth/firebase/user');
    }
}
