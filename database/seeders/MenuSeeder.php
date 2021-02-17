<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Entap\Admin\Database\Models\MenuItem;
use Entap\Admin\Database\Models\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUsersMenuItem();
        $this->createPackagesMenuItem();
        $this->createLogsMenuItem();
    }

    protected function createUsersMenuItem()
    {
        MenuItem::create([
            'title' => '一般ユーザー',
            'uri' => route('admin.users.index', null, false),
        ]);
        $usersPermission = Permission::create(['name' => 'admin.users']);
        $usersPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/auth/users*']);
    }

    protected function createPackagesMenuItem()
    {
        MenuItem::create([
            'title' => 'パッケージ管理',
            'uri' => route('admin.packages.index', null, false),
        ]);
        $packagesPermission = Permission::create(['name' => 'admin.packages']);
        $packagesPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/packages*']);
    }

    protected function createLogsMenuItem()
    {
        MenuItem::create([
            'title' => 'ログ検索',
            'uri' => route('admin.logs.index', null, false),
        ]);
        $logsPermission = Permission::create(['name' => 'admin.logs']);
        $logsPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/log*']);
    }
}
