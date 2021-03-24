<?php
namespace Tests\Support;

use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;

trait HasSuperUser
{
    protected function createSuperUser()
    {
        $user = User::factory()->create();
        $role = $this->createSuperRole();
        $user->roles()->save($role);
        return $user;
    }

    protected function createSuperRole()
    {
        if ($role = Role::where('name', 'administrator')->first()) {
            return $role;
        }
        return Role::factory()->create([
            'name' => 'administrator',
        ]);
    }

    public function actingAsSuperUser($driver = 'admin')
    {
        return $this->actingAs($this->createSuperUser(), $driver);
    }
}
