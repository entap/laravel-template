<?php
namespace Tests\Feature\Models;

use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_hasAnyPermission()
    {
        $user = User::factory()
            ->hasPermissions(['name' => 'a'])
            ->create();

        $this->assertTrue($user->hasAnyPermission('a', 'b'));

        $this->assertFalse($user->hasAnyPermission('b'));
    }

    public function test_hasAllPermissions()
    {
        $user = User::factory()
            ->hasPermissions(['name' => 'a'])
            ->create();

        $this->assertFalse($user->hasAllPermissions('a', 'b'));

        $this->assertTrue($user->hasAllPermissions('a'));
    }

    public function test_ロールの下も検査する()
    {
        $user = User::factory()
            ->has(Role::factory()->hasPermissions(['name' => 'a']), 'roles')
            ->create();

        $this->assertTrue($user->hasPermission('a'));
    }

    public function test_hasAnyRole()
    {
        $user = User::factory()
            ->hasRoles(['name' => 'manager'])
            ->create();

        $this->assertTrue($user->hasAnyRole('administrator', 'manager'));

        $this->assertFalse($user->hasAnyRole('administrator'));
    }

    public function test_hasAllRoles()
    {
        $user = User::factory()
            ->hasRoles(['name' => 'manager'])
            ->create();

        $this->assertFalse($user->hasAllRoles('administrator', 'manager'));

        $this->assertTrue($user->hasAllRoles('manager'));
    }
}
