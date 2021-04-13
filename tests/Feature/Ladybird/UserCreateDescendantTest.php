<?php

namespace Tests\Feature\Ladybird;

use Tests\TestCase;
use App\Models\Group;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreateDescendantTest extends TestCase
{
    public function test_配下のグループを追加する()
    {
        $group = Group::factory()
            ->hasMembers(1)
            ->create();
        $member = $group->members->first();
        $member->givePermissionTo($this->permission->name);
        $newGroup = Group::factory()->make(['parent_id' => null]);

        // TODO parent_idなしでもいいかも
        $response = $this->actingAs($member->user)->post(
            "/groups/{$group->id}/descendants",
            [
                'parent_id' => $group->id,
                'name' => $newGroup->name,
            ]
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'parent_id' => $group->id,
            'name' => $newGroup->name,
        ]);
    }

    public function test_孫も追加できる()
    {
        $group = Group::factory()
            ->hasMembers(1)
            ->create();
        $member = $group->members->first();
        $member->givePermissionTo($this->permission->name);
        $groupChild = Group::factory()
            ->for($group, 'parent')
            ->create();
        $newGroup = Group::factory()->make(['parent_id' => null]);

        $response = $this->actingAs($member->user)->post(
            "/groups/{$group->id}/descendants",
            [
                'parent_id' => $groupChild->id,
                'name' => $newGroup->name,
            ]
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'parent_id' => $groupChild->id,
            'name' => $newGroup->name,
        ]);
    }

    public function test_関係ないグループには追加できない()
    {
        $group = Group::factory()
            ->hasMembers(1)
            ->create();
        $member = $group->members->first();
        $member->givePermissionTo($this->permission->name);
        $otherGroup = Group::factory()->create();
        $newGroup = Group::factory()->make(['parent_id' => null]);

        $response = $this->actingAs($member->user)->post(
            "/groups/{$group->id}/descendants",
            [
                'parent_id' => $otherGroup->id,
                'name' => $newGroup->name,
            ]
        );
        $response->assertForbidden();
    }

    public function test_ユーザーがグループに入ってないと失敗する()
    {
        $user = User::factory()->create();
        $group = Group::factory()
            ->hasMembers(1)
            ->create();
        $newGroup = Group::factory()->make(['parent_id' => null]);

        // TODO parent_idなしでもいいかも
        $response = $this->actingAs($user)->post(
            "/groups/{$group->id}/descendants",
            [
                'parent_id' => $group->id,
                'name' => $newGroup->name,
            ]
        );
        $response->assertForbidden();
    }

    public function test_ユーザーに権限がないと失敗する()
    {
        $group = Group::factory()
            ->hasMembers(1)
            ->create();
        $member = $group->members->first();
        $newGroup = Group::factory()->make(['parent_id' => null]);

        // TODO parent_idなしでもいいかも
        $response = $this->actingAs($member->user)->post(
            "/groups/{$group->id}/descendants",
            [
                'parent_id' => $group->id,
                'name' => $newGroup->name,
            ]
        );
        $response->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::findOrCreate('group/descendants/write');
    }
}
