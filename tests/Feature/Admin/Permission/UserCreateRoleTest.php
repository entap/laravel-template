<?php

namespace Tests\Feature\Admin\Permission;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * ロールを作成できる
 * @group permissions
 */
class UserCreateRoleTest extends TestCase
{
    use WithAdministrator;

    public function test_ロールの作成ページを表示する()
    {
        $permissions = Permission::factory(2)->create();

        $this->get(route('admin.settings.roles.create'))
            ->assertOk()
            ->assertSee($permissions->pluck('name')->all());
    }

    public function test_ロールを作成する()
    {
        $role = Role::factory()->make();

        $this->createRoleSuccess(['name' => $role->name]);

        $this->assertDatabaseHas('admin_roles', [
            'name' => $role->name,
        ]);
    }

    public function test_名前は必須()
    {
        $this->createRole(['name' => ''])
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_名前は一意()
    {
        $role = Role::factory()->create();

        $this->createRole(['name' => $role->name])
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('name');
    }

    public function test_パーミッションを設定できる()
    {
        $newRole = Role::factory()->make();
        $permission = Permission::factory()->create();

        $this->createRoleSuccess([
            'name' => $newRole->name,
            'permissions' => [$permission->id],
        ]);

        $role = Role::where('name', $newRole->name)->first();
        $this->assertTrue($role->hasPermission($permission));
    }

    public function test_存在しないパーミッションは指定できない()
    {
        $role = Role::factory()->make();

        $this->createRole([
            'name' => $role->name,
            'permissions' => [0],
        ])
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('permissions.0');
    }

    public function test_スーパーユーザーでないとフォームを表示できない()
    {
        $this->userHasNoRole();

        $this->showCreateForm()->assertForbidden();
    }

    public function test_スーパーユーザーでないと作成できない()
    {
        $this->userHasNoRole();

        $role = Role::factory()->make();

        $this->createRole([
            'name' => $role->name,
        ])->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function showCreateForm()
    {
        return $this->get(route('admin.settings.roles.create'));
    }

    private function createRole($params)
    {
        return $this->post(route('admin.settings.roles.store'), $params);
    }

    private function createRoleSuccess($params)
    {
        return $this->createRole($params)->assertRedirect(
            route('admin.settings.roles.index')
        );
    }
}
