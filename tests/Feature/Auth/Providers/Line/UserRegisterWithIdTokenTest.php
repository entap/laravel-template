<?php
namespace Tests\Feature\Auth\Providers\Line;

use Tests\TestCase;
use App\Models\User;

class UserRegisterWithIdTokenTest extends TestCase
{
    public function test_IDトークンは必須()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('post', '/api/auth/line/user', [
            'id_token' => '',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('id_token');
    }
}
