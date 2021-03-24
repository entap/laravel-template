<?php

namespace Tests\Feature\Controllers\User;

use Entap\Admin\Database\Models\User;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

/**
 * 管理者を一覧できる
 * @group users
 */
class UserListUserTest extends TestCase
{
    use WithAdministrator;

    public function test_管理者の一覧を表示する()
    {
        $users = User::factory(2)->create();

        $this->get(route('admin.settings.users.index'))
            ->assertOk()
            ->assertSee($users->pluck('name')->all());
    }

    public function test_スーパーユーザーでないと失敗する()
    {
        $this->userHasNoRole();

        $this->get(route('admin.settings.users.index'))->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLoggedIn();
        $this->userIsAdministrator();
    }
}
