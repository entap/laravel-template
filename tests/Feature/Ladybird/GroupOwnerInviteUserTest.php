<?php

namespace Tests\Feature\Ladybird;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GroupOwnerInviteUserTest extends TestCase
{
    public function test_ユーザーを招待する()
    {
        $role = Role::create(['name' => 'group_member']);
        $group = Group::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAsUserHasPermission($group)->post(
            "/groups/{$group->id}/users",
            [
                'email' => $user->email,
                'role' => $role->name,
            ]
        );
        $response->assertOk();

        $this->assertDatabaseHas('group_members', [
            'group_id' => $group->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_権限がないと失敗する()
    {
        $role = Role::create(['name' => 'group_member']);
        $group = Group::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAsUserNotHasPermission($group)->post(
            "/groups/{$group->id}/users",
            [
                'email' => $user->email,
                'role' => $role->name,
            ]
        );
        $response->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::findOrCreate('group/members/write');
    }

    protected function actingAsUserHasPermission($group)
    {
        $user = User::factory()->create();
        $member = $group->assignUser($user->id);
        $member->givePermissionTo($this->permission->name);
        return $this->actingAs($user);
    }

    protected function actingAsUserNotHasPermission($group)
    {
        $user = User::factory()->create();
        $group->assignUser($user->id);
        return $this->actingAs($user);
    }
}
