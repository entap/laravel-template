<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use App\Models\Admin\Operation;
use App\Models\Admin\Permission;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        $role = $this->createSuperRole();
        $user = $this->createSuperUser();
        $user->roles()->save($role);
    }

    protected function createSuperUser()
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        return $user;
    }

    protected function createSuperRole()
    {
        $operation = Operation::create([
            'method' => '*',
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
