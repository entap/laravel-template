<?php

use Entap\Admin\Database\Models\Operation;
use Entap\Admin\Database\Models\Permission;
use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTablesSeeder extends Seeder
{
  public function run()
  {
    $role = $this->createSuperRole();

    $user = User::create([
      'name' => 'admin',
      'username' => 'admin',
      'password' => Hash::make('password'),
    ]);
    $user->roles()->save($role);
  }

  private function createSuperRole()
  {
    $operation = Operation::create([
      'method' => 'any',
      'action' => '*',
    ]);

    $permission = Permission::create([
      'name' => 'full access',
    ]);
    $permission->operations()->save($operation);

    $role = Role::create([
      'name' => 'administrator',
    ]);
    $role->permissions()->save($permission);

    return $role;
  }
}
