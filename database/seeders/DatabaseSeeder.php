<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTablesSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(LadybirdSeeder::class);

        if (config('app.env') === 'local') {
            $this->call(TestDatabaseSeeder::class);
        }
    }
}
