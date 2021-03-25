<?php

namespace Tests\Feature\Admin\Permission;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * ロールを変更できる
 * @group permissions
 */
class UserUpdateRoleTest extends TestCase
{
    use WithAdministrator;

    public function test_ロールの編集ページを表示する()
    {
        $permissions = Permission::factory(2)->create();

        $this->get(route('admin.settings.roles.edit', $this->role))
            ->assertOk()
            ->assertSee($this->role->name)
            ->assertSee($permissions->pluck('name')->all());
    }

    public function test_ロールを変更する()
    {
        $newRole = Role::factory()->make();

        $this->updateRoleSuccess(['name' => $newRole->name]);

        $this->assertDatabaseHas('admin_roles', [
            'id' => $this->role->id,
            'name' => $newRole->name,
        ]);
    }

    public function test_パーミッションを設定できる()
    {
        $permission = Permission::factory()->create();

        // 追加
        $this->updateRoleSuccess([
            'name' => $this->role->name,
            'permissions' => [$permission->id],
        ]);

        $this->role->refresh();
        $this->assertTrue($this->role->hasPermission($permission));

        // 削除
        $this->updateRoleSuccess([
            'name' => $this->role->name,
            'permissions' => [],
        ]);

        $this->role->refresh();
        $this->assertFalse($this->role->hasPermission($permission));
    }

    public function test_名前は必須()
    {
        $this->updateRole(['name' => ''])->assertSessionHasErrors('name');
    }

    public function test_名前は重複禁止()
    {
        $role = Role::factory()->create();

        $this->updateRole(['name' => $role->name])->assertSessionHasErrors(
            'name'
        );
    }

    public function test_存在しないパーミッションは指定できない()
    {
        $role = Role::factory()->make();

        $this->updateRole([
            'name' => $role->name,
            'permissions' => [0],
        ])->assertSessionHasErrors('permissions.0');
    }

    public function test_スーパーユーザーでないとフォームを表示できない()
    {
        $this->userHasNoRole();

        $this->get(
            route('admin.settings.roles.edit', $this->role)
        )->assertForbidden();
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $this->updateRole()->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function updateRole($params = [])
    {
        return $this->put(
            route('admin.settings.roles.update', $this->role),
            array_merge($this->role->toArray(), $params)
        );
    }

    private function updateRoleSuccess($params)
    {
        return $this->updateRole($params)->assertRedirect(
            route('admin.settings.roles.show', $this->role)
        );
    }
}
