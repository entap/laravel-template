<?php
namespace Tests\Feature\Console\Commands;

use Tests\TestCase;

class VendorPublishTest extends TestCase
{
    public function test_ファイルをコピーする()
    {
        $this->assertFileExists(config_path('admin.php'));

        $this->assertFileExists(public_path('vendor/admin/js/app.js'));

        $this->assertFileExists(public_path('vendor/admin/css/app.css'));
    }
}
