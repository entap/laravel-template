<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Entap\ClientPackager\Models\Package;
use Entap\Admin\Database\Models\MenuItem;
use Entap\Admin\Database\Models\Permission;
use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User as AdminUser;
use Entap\ClientPackager\Models\PackageRelease;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') === 'production') {
            $this->command->error('Production環境には適用できません。');
            die();
        }

        MenuItem::create([
            'title' => 'クライアントパッケージ',
            'uri' => route('admin.packages.index', null, false),
        ]);

        PackageRelease::truncate();
        Package::truncate();
        Package::factory(3)
            ->hasReleases(3)
            ->create();

        $usersPermission = Permission::create(['name' => 'admin.users']);
        $usersPermission
            ->operations()
            ->create(['method' => '*', 'action' => '/admin/auth/users*']);
        $rolesPermission = Permission::create(['name' => 'admin.roles']);
        $rolesPermission
            ->operations()
            ->create(['method' => '*', 'action' => '/admin/auth/roles*']);
        $packagesPermission = Permission::create(['name' => 'admin.packages']);
        $packagesPermission
            ->operations()
            ->create(['method' => '*', 'action' => '/admin/packages']);

        $authRole = Role::create(['name' => 'Auth administrator']);
        $authRole->permissions()->save($usersPermission);
        $authRole->permissions()->save($rolesPermission);

        $packageRole = Role::create(['name' => 'Package administrator']);
        $packageRole->permissions()->save($packagesPermission);

        $authAdministrator = AdminUser::factory()->create();
        $authAdministrator->roles()->save($authRole);
        $this->command->info(
            'Auth administrator username: ' . $authAdministrator->username
        );

        $packageAdministrator = AdminUser::factory()->create();
        $packageAdministrator->permissions()->save($packagesPermission);
        $this->command->info(
            'Package administrator username: ' . $authAdministrator->username
        );

        $superAdministrator = AdminUser::factory()->create();
        $superAdministrator->roles()->save($authRole);
        $superAdministrator->roles()->save($packageRole);
        $this->command->info(
            'Super administrator username: ' . $authAdministrator->username
        );
    }
}
