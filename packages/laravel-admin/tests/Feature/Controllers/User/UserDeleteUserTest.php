<?php

namespace Tests\Feature\Controllers\User;

use Entap\Admin\Database\Models\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * 管理者を削除できる
 * @group users
 */
class UserDeleteUserTest extends TestCase
{
    use WithAdministrator;

    public function test_管理者を削除する()
    {
        $user = User::factory()->create();

        $this->deleteUser($user)->assertRedirect(
            route('admin.settings.users.index')
        );

        $this->assertDeleted('admin_users', ['id' => $user->id]);
    }

    public function test_自分は削除できない()
    {
        $this->deleteUser($this->currentUser)->assertForbidden();
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $user = User::factory()->create();

        $this->deleteUser($user)->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }

    private function deleteUser($user)
    {
        return $this->delete(route('admin.settings.users.destroy', $user));
    }
}
