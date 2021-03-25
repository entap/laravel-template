<?php

namespace Tests\Feature\Admin\Auth;

use Tests\TestCase;
use App\Facades\Admin;
use App\Models\Admin\User;
use Tests\Support\WithAdministrator;

/**
 * ログアウトできる
 * @group auth
 */
class UserLogoutTest extends TestCase
{
    use WithAdministrator;

    public function test_ログアウトする()
    {
        $this->userLoggedIn();

        $this->logout()->assertRedirect(route('admin.login'));

        $this->assertFalse(Admin::guard()->check());
    }

    private function logout()
    {
        return $this->post(route('admin.logout'));
    }
}
