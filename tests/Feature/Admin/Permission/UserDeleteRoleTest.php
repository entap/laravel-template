<?php

namespace Tests\Feature\Admin\Permission;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * ロールを削除できる
 * @group permissions
 */
class UserDeleteRoleTest extends TestCase
{
    use WithAdministrator;

    public function test_ロールを削除する()
    {
        $role = Role::factory()->create();

        $this->deleteRole($role)->assertRedirect(
            route('admin.settings.roles.index')
        );

        $this->assertDeleted('admin_roles', [
            'id' => $role->id,
        ]);
    }

    public function test_ユーザーを持つロールは削除できない()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $role->users()->save($user);

        $this->deleteRole($role)
            ->assertRedirect(url()->previous())
            ->assertSessionHas('error', 'ユーザーを持つロールは削除できません');
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $role = Role::factory()->create();

        $this->deleteRole($role)->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function deleteRole($role)
    {
        return $this->delete(route('admin.settings.roles.destroy', $role));
    }
}
