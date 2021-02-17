<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSegment;
use Illuminate\Database\Seeder;
use Entap\Admin\Database\Models\Role;
use Entap\ClientPackager\Models\Package;
use Entap\Admin\Database\Models\MailType;
use Entap\Admin\Database\Models\MenuItem;
use Entap\Admin\Database\Models\Permission;
use Entap\Admin\Database\Models\MailTemplate;
use Entap\ClientPackager\Models\PackageRelease;
use Entap\Admin\Database\Models\LogRequestEntry;
use Entap\Admin\Database\Models\User as AdminUser;
use Illuminate\Database\Eloquent\Factories\Sequence;

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

        $this->runForApp();
        // $this->runForAdmin();
    }

    protected function runForApp()
    {
        User::factory(50)
            ->state(new Sequence([], ['created_at' => now()->subDay(5)]))
            ->hasDevices(2)
            ->create();

        LogRequestEntry::factory(20)
            ->state(new Sequence([], ['created_at' => now()->subDay(5)]))
            ->create();

        MailType::factory(5)
            ->has(MailTemplate::factory(3), 'templates')
            ->create();

        Package::factory(3)
            ->hasReleases(3)
            ->create();

        UserSegment::factory(5)->create();
    }

    // protected function runForAdmin()
    // {
    //     $authRole = Role::create(['name' => 'Auth administrator']);
    //     $authRole->permissions()->save($usersPermission);
    //     $authRole->permissions()->save($rolesPermission);

    //     $packageRole = Role::create(['name' => 'Package administrator']);
    //     $packageRole->permissions()->save($packagesPermission);

    //     $authAdministrator = AdminUser::factory()->create();
    //     $authAdministrator->roles()->save($authRole);
    //     $this->command->info(
    //         'Auth administrator username: ' . $authAdministrator->username
    //     );

    //     $packageAdministrator = AdminUser::factory()->create();
    //     $packageAdministrator->permissions()->save($packagesPermission);
    //     $this->command->info(
    //         'Package administrator username: ' . $packageAdministrator->username
    //     );

    //     $superAdministrator = AdminUser::factory()->create();
    //     $superAdministrator->roles()->save($authRole);
    //     $superAdministrator->roles()->save($packageRole);
    //     $this->command->info(
    //         'Super administrator username: ' . $superAdministrator->username
    //     );
    // }
}
