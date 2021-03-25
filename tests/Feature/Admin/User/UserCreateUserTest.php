<?php

namespace Tests\Feature\Admin\User;

use Tests\TestCase;
use App\Facades\Admin;
use Tests\Support\WithAdministrator;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use App\Models\Admin\Permission;
use App\Models\Admin\UserGroup;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * 管理者を作成できる
 * @group users
 */
class UserCreateUserTest extends TestCase
{
    use WithFaker;
    use WithAdministrator;

    public function test_作成ページを表示する()
    {
        $this->withoutExceptionHandling();

        $this->get(route('admin.settings.users.create'))
            ->assertOk()
            ->assertSee($this->roles->pluck('name')->all())
            ->assertSee($this->permissions->pluck('name')->all());
    }

    public function test_管理者を作成する()
    {
        $this->createUser()->assertRedirect(
            route('admin.settings.users.index')
        );

        $this->assertDatabaseHas('admin_users', [
            'name' => $this->name,
        ]);

        $this->assertTrue(
            Admin::guard()->attempt([
                'username' => $this->username,
                'password' => $this->password,
            ])
        );
    }

    public function test_ロールを設定できる()
    {
        $this->createUser([
            'roles' => [$this->roles[1]->id],
        ])->assertRedirect(route('admin.settings.users.index'));

        $user = User::where('username', $this->username)->first();
        $this->assertDatabaseHas('admin_user_role', [
            'user_id' => $user->id,
            'role_id' => $this->roles[1]->id,
        ]);
    }

    public function test_パーミッションを設定できる()
    {
        $this->createUser([
            'permissions' => [$this->permissions[1]->id],
        ])->assertRedirect(route('admin.settings.users.index'));

        $user = User::where('username', $this->username)->first();
        $this->assertDatabaseHas('admin_user_permission', [
            'user_id' => $user->id,
            'permission_id' => $this->permissions[1]->id,
        ]);
    }

    public function test_グループを設定できる()
    {
        $group = UserGroup::factory()->create();

        $this->createUser([
            'group_id' => $group->id,
        ])->assertRedirect(route('admin.settings.users.index'));

        $user = User::where('username', $this->username)->first();
        $this->assertDatabaseHas('admin_user_group_user', [
            'user_id' => $user->id,
            'group_id' => $group->id,
        ]);
    }

    public function test_名前は必須()
    {
        $this->createUser(['name' => ''])->assertSessionHasErrors('name');
    }

    public function test_ログインIDは必須()
    {
        $this->createUser(['username' => ''])->assertSessionHasErrors(
            'username'
        );
    }

    public function test_ログインIDは重複禁止()
    {
        $user = User::factory()->create();

        $this->createUser([
            'username' => $user->username,
        ])->assertSessionHasErrors('username');
    }

    public function test_パスワードは必須()
    {
        $this->createUser(['password' => ''])->assertSessionHasErrors(
            'password'
        );
    }

    public function test_パスワードは8文字以上()
    {
        $password = $this->faker->password(1, 7);

        $this->createUser([
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertSessionHasErrors('password');
    }

    public function test_確認用のパスワードとパスワードが一致しないと失敗する()
    {
        $this->createUser([
            'password_confirmation' => '',
        ])->assertSessionHasErrors('password');
    }

    public function test_存在しないロールは不可()
    {
        $this->createUser(['roles' => [0]])->assertSessionHasErrors('roles.0');
    }

    public function test_存在しないパーミッションは不可()
    {
        $this->createUser(['permissions' => [0]])->assertSessionHasErrors(
            'permissions.0'
        );
    }

    public function test_存在しないグループは不可()
    {
        $this->createUser(['group_id' => 0])->assertSessionHasErrors(
            'group_id'
        );
    }

    public function test_スーパーユーザーでないとフォームを表示できない()
    {
        $this->userHasNoRole();

        $this->get(route('admin.settings.users.create'))->assertForbidden();
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $this->createUser()->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();

        $this->roles = Role::factory(2)->create();
        $this->permissions = Permission::factory(2)->create();

        $user = User::factory()->make();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->password = $this->faker->password(8, 32);
    }

    private function createUser($params = [])
    {
        return $this->post(
            route('admin.settings.users.store'),
            array_merge(
                [
                    'name' => $this->name,
                    'username' => $this->username,
                    'password' => $this->password,
                    'password_confirmation' => $this->password,
                ],
                $params
            )
        );
    }
}
