<?php
namespace Tests\Support;

use Entap\Admin\Facades\Admin;
use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;
use Entap\Admin\Database\Models\Operation;
use Entap\Admin\Database\Models\Permission;

trait WithAdministrator
{
    protected $currentUser;

    protected function userCreated()
    {
        $this->currentUser = User::factory()->create();
    }

    protected function userLoggedIn()
    {
        $this->currentUser = User::factory()->create();
        $this->actingAs($this->currentUser, 'admin');
    }

    protected function userLoggedOut()
    {
        $this->currentUser = null;
        Admin::guard()->logout();
    }

    protected function userIsAdministrator()
    {
        $this->currentUser
            ->roles()
            ->save(Role::factory()->create(['name' => 'administrator']));
    }

    protected function userHasNoRole()
    {
        $this->currentUser->roles()->sync([]);
    }

    protected function userHasOperation($method, $action)
    {
        $role = Role::factory()->create();
        $role->users()->save($this->currentUser);
        $permission = Permission::factory()->create();
        $permission->roles()->save($role);
        $operation = Operation::factory()->create([
            'method' => $method,
            'action' => $action,
        ]);
        $operation->permissions()->save($permission);
    }
}
