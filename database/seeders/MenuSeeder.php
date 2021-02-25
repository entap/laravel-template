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
        $this->createDynamicContentsMenuItem();
        $this->createUserOpinionsMenuItem();
    }

    protected function createUsersMenuItem()
    {
        $parent = MenuItem::create([
            'title' => 'ユーザー管理',
        ]);

        MenuItem::create([
            'title' => 'ユーザー',
            'uri' => route('admin.users.index', null, false),
            'parent_id' => $parent->id,
        ]);

        $this->createTemporaryUsersMenuItem($parent);
        $this->createUserSegmentsMenuItem($parent);

        $this->createUsersPermission();
    }

    protected function createUserSegmentsMenuItem(MenuItem $parent = null)
    {
        MenuItem::create([
            'title' => 'ユーザーセグメント',
            'uri' => route('admin.user-segments.index', null, false),
            'parent_id' => $parent->id,
        ]);
    }

    protected function createUsersPermission()
    {
        $usersPermission = Permission::create(['name' => 'admin.users']);
        $usersPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/users*']);
        $usersPermission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/user-segments*']);
    }

    protected function createTemporaryUsersMenuItem(MenuItem $parent = null)
    {
        MenuItem::create([
            'title' => __('temporary_users.title'),
            'uri' => route('admin.temporary-users.index', null, false),
            'parent_id' => $parent->id,
        ]);
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

    protected function createDynamicContentsMenuItem()
    {
        $parent = MenuItem::create([
            'title' => 'コンテンツ管理',
        ]);
        MenuItem::create([
            'title' => 'カテゴリ管理',
            'uri' => route('admin.dynamic-categories.index', null, false),
            'parent_id' => $parent->id,
        ]);
        MenuItem::create([
            'title' => 'ページ管理',
            'uri' => route('admin.dynamic-pages.index', null, false),
            'parent_id' => $parent->id,
        ]);
        $permission = Permission::create(['name' => 'admin.contents']);
        $permission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/dynamic-*']);
    }

    protected function createUserOpinionsMenuItem()
    {
        MenuItem::create([
            'title' => '問い合わせ',
            'uri' => route('admin.opinions.index', null, false),
        ]);
        $permission = Permission::create(['name' => 'admin.opinions']);
        $permission
            ->operations()
            ->create(['method' => '*', 'action' => 'admin/opinions*']);
    }
}
