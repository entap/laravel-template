<?php

namespace Tests\Feature\Controllers\Auth;

use Tests\TestCase;
use Entap\Admin\Facades\Admin;
use Entap\Admin\Database\Models\User;
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
