<?php

namespace Tests\Feature\Admin\User;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use App\Facades\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * 管理者を変更できる
 * @group users
 */
class UserUpdateUserTest extends TestCase
{
    use WithFaker;
    use WithAdministrator;

    public function test_編集ページを表示する()
    {
        $this->get(route('admin.settings.users.edit', $this->user))
            ->assertOk()
            ->assertSee($this->user->name)
            ->assertSee($this->user->username)
            ->assertSee($this->roles->pluck('name')->all())
            ->assertSee($this->permissions->pluck('name')->all());
    }

    public function test_管理者を編集する()
    {
        $this->updateUserSuccess();

        $this->assertDatabaseHas('admin_users', [
            'name' => $this->name,
        ]);

        $this->assertTrue(
            Admin::guard()->attempt([
                'username' => $this->username,
                'password' => $this->currentPassword,
            ])
        );
    }

    public function test_パスワードを変更できる()
    {
        $newPassword = $this->faker->password(8, 32);

        $this->updateUserSuccess([
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $this->assertTrue(
            Admin::guard()->attempt([
                'username' => $this->username,
                'password' => $newPassword,
            ])
        );
    }

    public function test_ロールを設定できる()
    {
        $this->updateUserSuccess([
            'roles' => [$this->roles[1]->id],
        ]);

        $this->assertDatabaseHas('admin_user_role', [
            'user_id' => $this->user->id,
            'role_id' => $this->roles[1]->id,
        ]);
    }

    public function test_パーミッションを設定できる()
    {
        $this->updateUserSuccess([
            'permissions' => [$this->permissions[1]->id],
        ]);

        $this->assertDatabaseHas('admin_user_permission', [
            'user_id' => $this->user->id,
            'permission_id' => $this->permissions[1]->id,
        ]);
    }

    public function test_名前は必須()
    {
        $this->updateUser(['name' => ''])->assertSessionHasErrors('name');
    }

    public function test_ログインIDは必須()
    {
        $this->updateUser(['username' => ''])->assertSessionHasErrors(
            'username'
        );
    }

    public function test_ログインIDは自分以外と重複禁止()
    {
        $this->updateUserSuccess(['username' => $this->user->username]);

        $user = User::factory()->create();

        $this->updateUser([
            'username' => $user->username,
        ])->assertSessionHasErrors('username');
    }

    public function test_パスワードは8文字以上()
    {
        $password = $this->faker->password(1, 7);

        $this->updateUser([
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertSessionHasErrors('password');
    }

    public function test_確認用のパスワードとパスワードが一致しないと失敗する()
    {
        $this->updateUser([
            'password' => 'password1',
            'password_confirmation' => 'password2',
        ])->assertSessionHasErrors('password');
    }

    public function test_存在しないロールは不可()
    {
        $this->updateUser(['roles' => [0]])->assertSessionHasErrors('roles.0');
    }

    public function test_存在しないパーミッションは不可()
    {
        $this->updateUser(['permissions' => [0]])->assertSessionHasErrors(
            'permissions.0'
        );
    }

    public function test_スーパーユーザーでないとフォームを表示できない()
    {
        $this->userHasNoRole();

        $this->get(
            route('admin.settings.users.edit', $this->user)
        )->assertForbidden();
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $this->updateUser()->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();

        $this->currentPassword = $this->faker->password(8, 32);
        $this->user = User::factory()->create([
            'password' => Hash::make($this->currentPassword),
        ]);
        $this->roles = Role::factory(2)->create();
        $this->permissions = Permission::factory(2)->create();

        $newUser = User::factory()->make();
        $this->name = $newUser->name;
        $this->username = $newUser->username;
    }

    private function updateUser($params = [])
    {
        return $this->put(
            route('admin.settings.users.update', $this->user),
            array_merge(
                [
                    'name' => $this->name,
                    'username' => $this->username,
                ],
                $params
            )
        );
    }

    private function updateUserSuccess($params = [])
    {
        return $this->updateUser($params)->assertRedirect(
            route('admin.settings.users.show', $this->user)
        );
    }
}
