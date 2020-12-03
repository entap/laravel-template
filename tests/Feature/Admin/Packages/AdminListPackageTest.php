<?php

namespace Tests\Feature\Admin\Packages;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminListPackageTest extends TestCase
{
    public function test_パッケージの一覧を表示する()
    {
        $packages = Package::factory(2)->create();

        $this->get(route('admin.packages.index'))
            ->assertOk()
            ->assertSee($packages->pluck('name')->toArray());
    }
}
