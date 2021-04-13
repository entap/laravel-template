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
        $member = GroupMember::factory()->create();
        $group = $member->group;
        $otherMember = GroupMember::factory()
            ->for($group, 'group')
            ->create();

        $response = $this->actingAs($member->user)->get(
            "/groups/{$group->id}/members/{$otherMember->id}"
        );

        $response->assertOk();
    }

    public function test_ユーザーがグループに入っていないと失敗する()
    {
        $user = User::factory()->create();
        $otherMember = GroupMember::factory()->create();
        $group = $otherMember->group;

        $response = $this->actingAs($user)->get(
            "/groups/{$group->id}/members/{$otherMember->id}"
        );

        $response->assertForbidden();
    }

    // public function test_ユーザーに権限がないと失敗する()
    // {
    //     //
    // }

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     $this->permission = Permission::findOrCreate('group/members/read');
    // }
}
