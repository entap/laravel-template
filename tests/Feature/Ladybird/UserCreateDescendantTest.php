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
        $response = $this->actingAs($this->member->user)->createDescendant(
            $this->group,
            $this->newGroup
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'parent_id' => $this->group->id,
            'name' => $this->newGroup->name,
        ]);
    }

    public function test_孫も追加できる()
    {
        $groupChild = Group::factory()
            ->for($this->group, 'parent')
            ->create();

        $response = $this->actingAs($this->member->user)->createDescendant(
            $this->group,
            $this->newGroup,
            $groupChild
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'parent_id' => $groupChild->id,
            'name' => $this->newGroup->name,
        ]);
    }

    public function test_関係ないグループには追加できない()
    {
        $otherGroup = Group::factory()->create();

        $response = $this->actingAs($this->member->user)->createDescendant(
            $this->group,
            $this->newGroup,
            $otherGroup
        );
        $response->assertForbidden();
    }

    public function test_ユーザーがグループに入ってないと失敗する()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->createDescendant(
            $this->group,
            $this->newGroup
        );

        $response->assertForbidden();
    }

    public function test_ユーザーに権限がないと失敗する()
    {
        $this->member->revokePermissionTo($this->permission->name);

        $response = $this->actingAs($this->member->user)->createDescendant(
            $this->group,
            $this->newGroup
        );
        $response->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::findOrCreate('group/descendants/write');

        $this->group = Group::factory()
            ->hasMembers(1)
            ->create();
        $this->member = $this->group->members->first();
        $this->member->givePermissionTo($this->permission->name);
        $this->newGroup = Group::factory()->make(['parent_id' => null]);
    }

    protected function createDescendant($group, $newGroup, $parent = null)
    {
        // TODO 直下に入れる場合はparent_idなしでもいいかも

        return $this->post("/groups/{$group->id}/descendants", [
            'parent_id' => ($parent ?? $group)->id,
            'name' => $newGroup->name,
        ]);
    }
}
