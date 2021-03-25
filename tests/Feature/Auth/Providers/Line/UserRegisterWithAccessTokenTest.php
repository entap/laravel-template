<?php
namespace Tests\Feature\Auth\Providers\Line;

use Tests\TestCase;
use App\Models\User;
use App\Services\Auth\Line\VerifiedToken;
use App\Services\Auth\Line\VerifyService;

class UserRegisterWithAccessTokenTest extends TestCase
{
    public function test_認証連携を登録する()
    {
        $this->mock(VerifyService::class, function ($mock) {
            $mock->shouldReceive('verify')->andReturn(new VerifiedToken('xxx'));
        });

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('post', '/api/auth/line/user', [
            'access_token' => 'yyy',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('auth_providers', [
            'user_id' => $user->id,
            'name' => 'line',
            'code' => 'xxx',
        ]);
    }

    public function test_他のユーザーが使っているアカウントは使えない()
    {
        $this->mock(VerifyService::class, function ($mock) {
            $mock->shouldReceive('verify')->andReturn(new VerifiedToken('xxx'));
        });

        $other = User::factory()->create();
        $other->saveProvider('line', 'xxx');
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('post', '/api/auth/line/user', [
            'access_token' => 'yyy',
        ]);

        $response->assertStatus(400);
    }

    public function test_アクセストークンは必須()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('post', '/api/auth/line/user', [
            'access_token' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors('access_token');
    }
}
