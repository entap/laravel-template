<?php

namespace Tests\Feature\Ladybird;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserGetMembers extends TestCase
{
    public function test_メンバーを一覧する()
    {
        $group = Group::factory()->create();

        $response = $this->get("/groups/{$group->id}/members");

        $response->assertOk();
    }

    // public function test_ユーザーがメンバーでないと失敗する()
    // {
    //     $this->fail();
    // }

    // public function test_ユーザーに権限がないと失敗する()
    // {
    //     $this->fail();
    // }
}
