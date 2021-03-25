<?php

namespace Database\Seeders;

use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\DynamicCategory;
use App\Models\DynamicContent;
use App\Models\DynamicPage;
use App\Models\TemporaryUser;
use App\Models\User;
use App\Models\UserOpinion;
use App\Models\UserSegment;
use Illuminate\Database\Seeder;
use App\Models\Admin\Role;
use App\Models\Package;
use App\Models\Admin\MailType;
use App\Models\Admin\MenuItem;
use App\Models\Admin\Permission;
use App\Models\Admin\MailTemplate;
use App\Models\PackageRelease;
use App\Models\Admin\LogRequestEntry;
use App\Models\Admin\User as AdminUser;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;

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
        // Passport
        DB::table('oauth_clients')->insert([
            'id' => 1,
            'name' => 'Laravel Password Grant Client',
            'secret' => '2Tk9FPCPmXJHcBTwF0SBNAszGThZ3QtV8qtfPT1Q',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
        ]);

        User::factory()->create([
            'email' => 'test@example.com',
        ]);

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

        TemporaryUser::factory(15)->create();

        DynamicPage::factory(5)
            ->has(DynamicContent::factory(5), 'contents')
            ->create();

        DynamicCategory::factory(5)->create();

        UserOpinion::factory(10)->create();

        AgreementType::factory()
            ->hasAgreements(3)
            ->create(['slug' => 'test']);
        Agreement::factory(10)->create();
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
