<?php

namespace Tests\Feature\Ladybird;

use App\Models\GroupMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserGetMemberTest extends TestCase
{
    public function test_ユーザーを取得する()
    {
        $member = GroupMember::factory()->create();
        $group = $member->group;

        $response = $this->get("/groups/{$group->id}/members/{$member->id}");

        $response->assertOk();
    }

    // public function test_グループに入っていないと失敗する()
    // {
    //     //
    // }

    // public function test_権限がないと失敗する()
    // {
    //     //
    // }
}
