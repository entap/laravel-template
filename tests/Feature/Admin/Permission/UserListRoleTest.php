<?php

namespace Tests\Feature\Admin\Permission;

use App\Models\Admin\Role;
use App\Models\Admin\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * ロールを一覧できる
 * @group permissions
 */
class UserListRoleTest extends TestCase
{
    use WithAdministrator;

    public function test_ロールの一覧を表示する()
    {
        $roles = Role::factory(2)->create();

        $this->get(route('admin.settings.roles.index'))
            ->assertOk()
            ->assertSee($roles->pluck('name')->all());
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $this->get(route('admin.settings.roles.index'))->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }
}
