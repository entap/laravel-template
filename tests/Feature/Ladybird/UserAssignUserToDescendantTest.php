<?php

namespace Tests\Feature\Ladybird;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAssignUserToDescendantTest extends TestCase
{
    public function test_配下のグループにユーザーを追加する()
    {
        $parent = Group::factory()->create();
        $child = Group::factory()
            ->for($parent, 'parent')
            ->create();
        $user = User::factory()->create();
        $parent->assignUser($user->id);
        $targetUser = User::factory()->create();
        $targetMember = $parent->assignUser($targetUser->id);

        $response = $this->post(
            "/groups/{$parent->id}/descendants/{$child->id}/users",
            ['member_id' => $targetMember->id]
        );
        $response->assertOk();

        $this->assertDatabaseHas('group_members', [
            'group_id' => $child->id,
            'user_id' => $targetUser->id,
        ]);
    }

    // public function test_権限がないと失敗する()
    // {
    //     $this->fail();
    // }

    // public function test_配下のグループでないと失敗する()
    // {
    //     $this->fail();
    // }

    // public function test_紐づけるのは親のメンバーでないと失敗する()
    // {
    //     $this->fail();
    // }

    // public function test_メンバーに含まれていたら何もしない()
    // {
    //     $this->fail();
    // }
}
