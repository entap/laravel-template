<?php

namespace Tests\Feature\Controllers;

use Tests\Support\WithAdministrator;
use Tests\TestCase;

class UserVisitHomeTest extends TestCase
{
    use WithAdministrator;

    public function test_ユーザー情報を表示する()
    {
        $this->userLoggedIn();

        $this->visitHome()
            ->assertOk()
            ->assertSee($this->currentUser->name);
    }

    public function test_ログインしてないとログインページに戻される()
    {
        $this->visitHome()->assertRedirect(route('admin.login'));
    }

    private function visitHome()
    {
        return $this->get(route('admin.home'));
    }
}
