<?php
namespace Database\Seeders;

use App\Models\MenuItem;
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
        $this->createSuperUser($role);

        $this->createMenu();
    }

    protected function createSuperUser($superRole)
    {
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $user->roles()->save($superRole);

        return $user;
    }

    protected function createSuperRole()
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

    protected function createMenu()
    {
        MenuItem::create([
            'title' => '管理者',
            'uri' => route('admin.users.index', null, false),
        ]);
        MenuItem::create([
            'title' => '管理権限',
            'uri' => route('admin.roles.index', null, false),
        ]);
        MenuItem::create([
            'title' => '管理メニュー',
            'uri' => route('admin.menu.items.index', null, false),
        ]);
    }
}
