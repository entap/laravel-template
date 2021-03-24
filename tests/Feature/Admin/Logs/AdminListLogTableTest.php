<?php
namespace Tests\Feature\Admin\Logs;

use Tests\TestCase;
use Tests\Support\HasLogTables;
use Tests\Support\HasSuperUser;

class AdminListLogTableTest extends TestCase
{
    use HasSuperUser;
    use HasLogTables;

    public function test_検索フォームを表示する()
    {
        $response = $this->actingAsSuperUser()->get(route('admin.logs.index'));

        $response
            ->assertOk()
            ->assertSee(['log_xxx_entries', 'log_yyy_entries'])
            ->assertDontSee('zzz_entries')
            ->assertSee(__('Search'));
    }
}
