<?php

namespace Tests;

use Entap\Admin\Facades\Admin;
use Entap\Admin\AdminServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\TestServiceProvider;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . "/Support/Database/Migrations");
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");

        $this->artisan('vendor:publish', [
            '--force' => true,
            '--provider' => "Entap\Admin\AdminServiceProvider",
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminServiceProvider::class,
            NestedSetServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Admin' => Admin::class,
        ];
    }
}
