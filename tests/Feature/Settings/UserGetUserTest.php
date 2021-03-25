<?php

namespace Tests\Feature\Settings;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * ユーザーとして、自身の情報を取得する
 */
class UserGetUserTest extends TestCase
{
    public function test_自身の情報を取得する()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson('/api/user');
        $response->assertOk();
    }
}
