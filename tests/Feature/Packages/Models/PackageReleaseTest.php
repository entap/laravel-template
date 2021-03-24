<?php

namespace Tests\Feature\Packages\Models;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\PackageRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageReleaseTest extends TestCase
{
    public function test_公開されたリリースを絞り込む()
    {
        $this->travelTo(new Carbon('2020-05-05 12:30:00'));

        $r1 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:30:01',
        ]);
        $r2 = PackageRelease::factory()->create([
            'publish_date' => '2020-05-05 12:30:00',
        ]);

        $releases = PackageRelease::published()->get();

        $this->assertEquals(1, $releases->count());
        $this->assertEquals($r2->id, $releases[0]->id);
    }

    public function test_廃止されていないリソースを絞り込む()
    {
        $this->travelTo(new Carbon('2020-04-30 16:00'));

        $r1 = PackageRelease::factory()->create([
            'expire_date' => '2020-04-30 16:00:01',
        ]);
        $r2 = PackageRelease::factory()->create([
            'expire_date' => '2020-04-30 16:00',
        ]);

        $releases = PackageRelease::notExpired()->get();

        $this->assertEquals(1, $releases->count());
        $this->assertEquals($r1->id, $releases[0]->id);
    }

    public function test_最新版を絞り込める()
    {
        // TODO Serviceとかにまとめる

        $r0 = PackageRelease::factory()->create(['version' => '5.0.1']);
        $r1 = PackageRelease::factory()->create(['version' => '20.0.1']);
        $r2 = PackageRelease::factory()->create(['version' => '5.103.1']);
        $r3 = PackageRelease::factory()->create(['version' => '2.13.15']);

        $releases = PackageRelease::available()->get();
        $release = $releases->sortBy('version', SORT_NATURAL)->last();

        $this->assertEquals($r1->id, $release->id);
    }
}
