<?php
namespace Tests\Feature\Console\Commands;

use Entap\Admin\Facades\Admin;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    public function test_新しいユーザーを作成できる()
    {
        $this->artisan('admin:users:create')
            ->expectsQuestion('What is your name?', 'Admin')
            ->expectsQuestion('What is your login username?', 'admin')
            ->expectsQuestion('What is your login password?', 'password')
            ->assertExitCode(0);

        $this->assertDatabaseHas('admin_users', [
            'name' => 'Admin',
            'username' => 'admin',
        ]);
        $this->assertTrue(
            Admin::guard()->attempt([
                'username' => 'admin',
                'password' => 'password',
            ])
        );
    }
}
