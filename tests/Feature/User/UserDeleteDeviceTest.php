<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDeleteDeviceTest extends TestCase
{
    public function test_端末を削除する()
    {
        $user = User::factory()->create();
        $userDevice = UserDevice::factory()
            ->for($user)
            ->create();

        $response = $this->actingAs($user, 'api')->deleteUserDevice(
            $userDevice
        );

        $response->assertNoContent();

        $this->assertDeleted('user_devices', [
            'id' => $userDevice->id,
        ]);
    }

    private function deleteUserDevice($userDevice)
    {
        return $this->deleteJson(route('devices.destroy', $userDevice));
    }
}
