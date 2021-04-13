<?php

namespace Tests\Feature\Ladybird;

use Tests\TestCase;
use App\Models\User;
use App\Models\GroupMember;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserGetMemberTest extends TestCase
{
    public function test_メンバーを取得する()
    {
        $response = $this->actingAs($this->member->user)->getMember(
            $this->group,
            $this->otherMember
        );

        $response->assertOk();
    }

    public function test_ユーザーがグループに入っていないと失敗する()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getMember(
            $this->group,
            $this->otherMember
        );

        $response->assertForbidden();
    }

    public function test_ユーザーに権限がないと失敗する()
    {
        $this->member->revokePermissionTo('group/members/read');

        $response = $this->actingAs($this->member->user)->getMember(
            $this->group,
            $this->otherMember
        );

        $response->assertForbidden();
    }

    // public function test_グループのメンバー以外は取得できない()
    // {
    //     $this->fail();
    // }

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::findOrCreate('group/members/read');

        $this->member = GroupMember::factory()->create();
        $this->member->givePermissionTo('group/members/read');
        $this->group = $this->member->group;
        $this->otherMember = GroupMember::factory()
            ->for($this->group, 'group')
            ->create();
    }

    protected function getMember($group, $member)
    {
        return $this->get("/groups/{$group->id}/members/{$member->id}");
    }
}
