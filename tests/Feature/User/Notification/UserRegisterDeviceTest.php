<?php

namespace Tests\Feature\User\Notification;

use App\Models\User;
use Tests\TestCase;
use App\Models\UserNotificationDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * 利用者として、通知先を登録できる
 */
class UserRegisterDeviceTest extends TestCase
{
    public function test_通知先を登録する()
    {
        $user = User::factory()->create();
        $newDevice = UserNotificationDevice::factory()->make();

        $response = $this->actingAs($user, 'api')->postJson(
            '/api/notification/devices',
            [
                'token' => $newDevice->token,
            ]
        );

        $response->assertCreated();
    }
}
