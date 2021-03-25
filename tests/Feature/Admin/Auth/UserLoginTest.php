<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Admin\User;
use App\Facades\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\Support\WithAdministrator;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use WithFaker;
    use WithAdministrator;

    public function test_ログインフォームを表示する()
    {
        $this->showLoginForm()
            ->assertOk()
            ->assertViewIs('admin.auth.login')
            ->assertSee(__('Login'));
    }

    public function test_ログインしているとホームに移動する()
    {
        $this->actingAs(User::factory()->create(), 'admin');

        $this->showLoginForm()->assertRedirect(route('admin.home'));
    }

    public function test_ログインできる()
    {
        $password = $this->faker->password(8, 32);
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $this->login($user->username, $password)->assertRedirect(
            route('admin.home')
        );

        $this->assertEquals($user->id, Admin::user()->id);
    }

    public function test_ログインしていると省略する()
    {
        $this->userLoggedIn();
        $this->actingAs(User::factory()->create(), 'admin');

        $this->login('', '')->assertRedirect(route('admin.home'));
    }

    public function test_認証情報を間違えるとログインできない()
    {
        $this->login('xxxxxxx', 'xxxxxxxx')
            ->assertRedirect(url()->previous())
            ->assertSessionHasErrors(['username']);
    }

    private function showLoginForm()
    {
        return $this->get(route('admin.login'));
    }

    private function login($username, $password)
    {
        return $this->post(route('admin.login'), [
            'username' => $username,
            'password' => $password,
        ]);
    }
}
