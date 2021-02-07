<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use App\Models\UserDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUpdateDeviceTest extends TestCase
{
    public function test_UserDeviceを更新する()
    {
        $user = User::factory()->create();
        $userDevice = UserDevice::factory()
            ->for($user)
            ->create();
        $newUserDevice = UserDevice::factory()->make();

        $response = $this->actingAs($user, 'api')->saveUserDevice(
            $userDevice,
            $newUserDevice->toArray()
        );

        $response->assertOk();

        $this->assertDatabaseHas('user_devices', [
            'id' => $userDevice->id,
            'user_id' => $user->id,
        ]);
    }

    // TODO ユーザーの端末でないと失敗する

    private function saveUserDevice($userDevice, $params = [])
    {
        return $this->put(route('devices.update', $userDevice), $params);
    }
}
