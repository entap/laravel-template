<?php
namespace Tests\Feature\Auth\Providers\Firebase;

use Tests\TestCase;
use App\Models\User;
use App\Gateways\Firebase\VerifiedToken;
use App\Gateways\Firebase\VerifyIdTokenGateway;

class UserRegisterTest extends TestCase
{
    public function test_認証連携を登録する()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->register('xxx');

        $response->assertOk();

        $this->assertDatabaseHas('auth_providers', [
            'user_id' => $user->id,
            'name' => 'firebase',
            'code' => 'xxx',
        ]);
    }

    public function test_ログインしてないと失敗する()
    {
        $response = $this->register('xxx');

        $response->assertUnauthorized();
    }

    public function test_IDトークンは必須()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');
        $response = $this->register('');

        $response->assertStatus(422)->assertJsonValidationErrors('id_token');
    }

    public function test_すでに利用されているユーザーは登録できない()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $other->saveProvider('firebase', 'xxx');

        // 自分以外と重複禁止
        $this->actingAs($user, 'api');
        $response = $this->register('xxx');
        $response->assertStatus(400);

        // 自分とは重複してもよい
        $this->actingAs($other, 'api');
        $this->register('xxx')->assertOk();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock(VerifyIdTokenGateway::class, function ($mock) {
            $mock->shouldReceive('verify')->andReturn(new VerifiedToken('xxx'));
        });
    }

    protected function register($idToken)
    {
        return $this->json('post', '/api/auth/firebase/user', [
            'id_token' => $idToken,
        ]);
    }
}
