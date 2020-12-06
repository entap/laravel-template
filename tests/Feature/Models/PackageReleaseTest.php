<?php

namespace Tests\Feature\Models;

use App\Models\PackageRelease;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageReleaseTest extends TestCase
{
    public function test_公開されたリリースだけを検索できる()
    {
        $this->travelTo(new Carbon('2020-05-05 12:30'));

        $p1 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:29',
        ]);
        $p2 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:30',
        ]);

        $packages = PackageRelease::published()->get();

        $this->assertEquals(1, $packages->count());
        $this->assertEquals($p2->id, $packages[0]->id);
    }
}
