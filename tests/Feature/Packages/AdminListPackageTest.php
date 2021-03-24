<?php

namespace Tests\Feature\Packages;

use Tests\TestCase;
use App\Models\Package;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\HasSuperUser;

class AdminListPackageTest extends TestCase
{
    use HasSuperUser;

    public function test_パッケージの一覧を表示する()
    {
        $packages = Package::factory(2)->create();

        $this->actingAsSuperUser()
            ->get(route('admin.packages.index'))
            ->assertOk()
            ->assertSee($packages->pluck('name')->toArray());
    }
}
