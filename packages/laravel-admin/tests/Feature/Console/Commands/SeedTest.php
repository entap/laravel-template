<?php
use Tests\TestCase;

class SeedTest extends TestCase
{
    public function test_初期データを投入する()
    {
        $this->artisan('admin:seed')->assertExitCode(0);

        $this->assertDatabaseHas('admin_users', [
            'name' => 'Admin',
            'username' => 'admin',
        ]);
    }
}
