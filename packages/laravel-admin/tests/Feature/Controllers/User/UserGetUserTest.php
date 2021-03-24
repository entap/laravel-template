<?php

namespace Tests\Feature\Controllers\User;

use Entap\Admin\Database\Models\Permission;
use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * 管理者を取得できる
 * @group users
 */
class UserGetUserTest extends TestCase
{
    use WithAdministrator;

    public function test_管理者を表示する()
    {
        $user = User::factory()->create();
        $roles = Role::factory(2)->create();
        $permissions = Permission::factory(2)->create();
        $user->roles()->sync($roles);
        $user->permissions()->sync($permissions);

        $this->get(route('admin.settings.users.show', $user))
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee($roles->pluck('name')->all())
            ->assertSee($permissions->pluck('name')->all());
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $user = User::factory()->create();

        $this->get(
            route('admin.settings.users.show', $user)
        )->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }
}
