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
        // users
        MenuItem::create([
            'title' => '一般ユーザー',
            'uri' => route('admin.users.index', null, false),
        ]);
        $usersPermission = Permission::create(['name' => 'admin.users']);
        $usersPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/auth/users*']);

        // packages
        MenuItem::create([
            'title' => 'クライアントパッケージ',
            'uri' => route('admin.packages.index', null, false),
        ]);
        $packagesPermission = Permission::create(['name' => 'admin.packages']);
        $packagesPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/packages*']);

        // logs
        MenuItem::create([
            'title' => 'ログ検索',
            'uri' => route('log.tables.index', null, false),
        ]);
        $logsPermission = Permission::create(['name' => 'admin.logs']);
        $logsPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/log*']);
    }
}
