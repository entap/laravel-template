<?php

namespace Tests\Feature\Admin\Permission;

use Tests\TestCase;
use Tests\Support\WithAdministrator;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use App\Models\Admin\Permission;

/**
 * ロールを取得できる
 * @group permissions
 */
class UserGetRoleTest extends TestCase
{
    use WithAdministrator;

    public function test_ロールを表示する()
    {
        $role = Role::factory()->create();
        $permissions = Permission::factory(2)->create();
        $role->permissions()->sync($permissions->pluck('id')->all());

        $this->get(route('admin.settings.roles.show', $role))
            ->assertOk()
            ->assertSee($role->name)
            ->assertSee($permissions->pluck('name')->all());
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $role = Role::factory()->create();

        $this->get(
            route('admin.settings.roles.show', $role)
        )->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }
}
