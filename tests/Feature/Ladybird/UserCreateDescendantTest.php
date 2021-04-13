<?php

namespace Tests\Feature\Ladybird;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateDescendantTest extends TestCase
{
    public function test_配下のグループを追加する()
    {
        $group = Group::factory()->create();
        $groupChild = Group::factory()
            ->for($group, 'parent')
            ->create();
        $newGroup = Group::factory()->make(['parent_id' => null]);

        $response = $this->post("/groups/{$group->id}/descendants", [
            'parent_id' => $groupChild->id,
            'name' => $newGroup->name,
        ]);
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'parent_id' => $groupChild->id,
            'name' => $newGroup->name,
        ]);
    }

    // public function test_外のグループには追加できない()
    // {
    //     $this->fail();
    // }
}
