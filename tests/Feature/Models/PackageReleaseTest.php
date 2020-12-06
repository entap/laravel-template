<?php

namespace Tests\Feature\Models;

use App\Models\PackageRelease;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageReleaseTest extends TestCase
{
    public function test_公開されたリリースを絞り込む()
    {
        $this->travelTo(new Carbon('2020-05-05 12:30:00'));

        $p1 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:30:01',
        ]);
        $p2 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:30:00',
        ]);

        $packages = PackageRelease::published()->get();

        $this->assertEquals(1, $packages->count());
        $this->assertEquals($p2->id, $packages[0]->id);
    }

    public function test_廃止されていないリソースを絞り込む()
    {
        $this->travelTo(new Carbon('2020-04-30 16:00'));

        $p1 = PackageRelease::factory()->create([
            'expire_date' => '2020-04-30 16:00:01',
        ]);
        $p2 = PackageRelease::factory()->create([
            'expire_date' => '2020-04-30 16:00',
        ]);

        $packages = PackageRelease::notExpired()->get();

        $this->assertEquals(1, $packages->count());
        $this->assertEquals($p1->id, $packages[0]->id);
    }
}
