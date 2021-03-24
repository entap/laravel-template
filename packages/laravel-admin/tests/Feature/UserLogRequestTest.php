<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Support\Database\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserLogRequestTest extends TestCase
{
    use WithFaker;

    public function test_リクエストログを記録する()
    {
        $response = $this->deleteJson(route('user.destroy'));

        $response->assertNoContent();

        $this->assertDatabaseHas('log_request_entries', [
            // 'uuid',
            'host' => '127.0.0.1',
            'method' => 'delete',
            'action' => 'user',
            'status' => 204,
            'request_body' => json_encode([]),
            'response_body' => '',
        ]);
    }

    public function test_リクエストとレスポンスの内容を記録する()
    {
        $requestBody = [
            'title' => $this->faker->title,
            'body' => $this->faker->paragraph,
        ];
        $responseBody = [
            'message' => 'Hello World',
        ];
        $response = $this->json('post', route('home'), $requestBody);

        $response->assertOk();

        $this->assertDatabaseHas('log_request_entries', [
            // 'uuid',
            'host' => '127.0.0.1',
            'method' => 'post',
            'action' => '/',
            'status' => 200,
            'request_body' => json_encode($requestBody),
            'response_body' => json_encode($responseBody),
        ]);
    }

    public function test_端末情報を追加できる()
    {
        $headers = [
            'X-Device-Name' => $this->faker->uuid,
            'X-Device-Brand' => $this->faker->uuid,
            'X-OS-Name' => $this->faker->uuid,
            'X-OS-Version' => $this->faker->uuid,
            'X-Package-Name' => $this->faker->uuid,
            'X-Package-Version' => $this->faker->uuid,
        ];
        $response = $this->json('post', route('home'), [], $headers);

        $response->assertOk();

        $this->assertDatabaseHas('log_request_entries', [
            'device' => $headers['X-Device-Name'],
            'device_brand' => $headers['X-Device-Brand'],
            'platform' => $headers['X-OS-Name'],
            'platform_version' => $headers['X-OS-Version'],
            'package_name' => $headers['X-Package-Name'],
            'package_version' => $headers['X-Package-Version'],
        ]);
    }

    public function test_ユーザー情報を追加できる()
    {
        $user = User::create();
        $this->actingAs($user, 'api');

        $response = $this->json('post', route('home'));

        $response->assertOk();

        $this->assertDatabaseHas('log_request_entries', [
            'user_id' => $user->id,
        ]);
    }

    // TODO 記録したあとはRequestのパラメータにもuuid入れとく？_request_log_uuidとか
}
