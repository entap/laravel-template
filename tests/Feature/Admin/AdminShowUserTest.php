<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminShowUserTest extends TestCase
{
    use HasSuperUser;

    public function test_詳細を表示する()
    {
        $user = User::factory()->create();

        $response = $this->actingAsSuperUser()->get(
            '/admin/users/' . $user->id
        );

        $response->assertOk()->assertSee($user->name);
    }
}
