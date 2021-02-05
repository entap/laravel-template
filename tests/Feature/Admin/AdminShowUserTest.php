<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Entap\Admin\Database\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Entap\Admin\Database\Models\User as AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminShowUserTest extends TestCase
{
    public function test_詳細を表示する()
    {
        $admin = AdminUser::factory()
            ->has(
                Role::factory()->state(function () {
                    return ['name' => 'administrator'];
                })
            )
            ->create();

        $user = User::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get(
            '/admin/users/' . $user->id
        );

        $response->assertOk()->assertSee($user->name);
    }
}
