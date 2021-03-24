<?php
namespace Entap\Admin\Application\Console\Commands;

use Illuminate\Console\Command;
use Entap\Admin\AdminServiceProvider;

class Install extends Command
{
    protected $signature = 'admin:install';
    protected $description = 'Install the admin package.';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => AdminServiceProvider::class,
            '--tag' => ['config', 'assets'],
        ]);
    }
}
