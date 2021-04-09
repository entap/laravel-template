<?php

namespace Tests\Feature\Ladybird;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GroupOwnerInviteUserTest extends TestCase
{
    public function test_ユーザーを招待する()
    {
        $role = Role::create(['name' => 'group_member']);
        $group = Group::factory()->create();
        $user = User::factory()->create();

        $response = $this->post("/groups/{$group->id}/users", [
            'email' => $user->email,
            'role' => $role->name,
        ]);
        $response->assertOk();

        $this->assertDatabaseHas('group_members', [
            'group_id' => $group->id,
            'user_id' => $user->id,
        ]);
    }
}
