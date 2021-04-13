<?php

namespace Tests\Feature\Ladybird;

use Tests\TestCase;
use App\Models\Group;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserGetMembers extends TestCase
{
    public function test_メンバーを一覧する()
    {
        $group = Group::factory()
            ->hasMembers(2)
            ->create();
        $member = $group->members->first();
        $member->givePermissionTo('group/members/read');

        $response = $this->actingAs($member->user)->get(
            "/groups/{$group->id}/members"
        );

        $response->assertOk();
    }

    // 権限周りは詳細と同じなので省略

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::findOrCreate('group/members/read');
    }
}
