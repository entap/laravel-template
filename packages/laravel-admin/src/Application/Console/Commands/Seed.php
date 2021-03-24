<?php
namespace Entap\Admin\Application\Console\Commands;

use Illuminate\Console\Command;
use Entap\Admin\Database\Models\User;
use Database\Seeders\Entap\Admin\AdminTablesSeeder;

class Seed extends Command
{
    protected $signature = 'admin:seed';
    protected $description = 'Seed';

    public function handle()
    {
        // データがあったら省略する
        if (User::count() > 0) {
            return;
        }

        $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
    }
}
