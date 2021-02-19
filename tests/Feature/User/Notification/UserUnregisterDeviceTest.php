<?php

namespace Tests\Feature\User\Notification;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserNotificationDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUnregisterDeviceTest extends TestCase
{
    public function test_通知先を削除する()
    {
        $user = User::factory()->create();
        $device = UserNotificationDevice::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->deleteJson(
            "/api/notification/devices/{$device->token}"
        );

        $response->assertNoContent();

        $this->assertDeleted('user_notification_devices', [
            'id' => $device->id,
        ]);
    }
}
