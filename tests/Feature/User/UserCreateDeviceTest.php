<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use App\Models\UserDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreateDeviceTest extends TestCase
{
    public function test_UserDeviceを追加する()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $newUserDevice = UserDevice::factory()->make();

        $response = $this->actingAs($user, 'api')->saveUserDevice(
            $newUserDevice->only(['uuid'])
        );
        $response->assertCreated();

        $this->assertDatabaseHas('user_devices', []);
    }

    private function saveUserDevice($params = [])
    {
        return $this->json(
            'post',
            route('devices.store'),
            array_merge([], $params)
        );
    }
}
