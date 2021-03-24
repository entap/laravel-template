<?php
namespace Tests\Feature\Admin\Logs;

use Tests\Support\HasLogTables;
use Tests\Support\HasSuperUser;
use Tests\Support\Models\LogXxxEntry;
use Tests\TestCase;

class AdminListLogEntryTest extends TestCase
{
    use HasLogTables;
    use HasSuperUser;

    public function test_一覧を表示する()
    {
        $log1 = LogXxxEntry::create();
        $log2 = LogXxxEntry::create();

        $tableName = 'log_xxx_entries';
        $response = $this->listEntries([
            'table' => $tableName,
        ]);

        $response
            ->assertOk()
            ->assertSee($tableName)
            ->assertSee('Id')
            ->assertSee('Created At')
            ->assertSee('Updated At')
            ->assertSee($log1->id)
            ->assertSee($log2->id);
    }

    public function test_日付の始点で絞り込む()
    {
        $log1 = LogXxxEntry::create();
        $this->travel(1)->seconds();
        $log2 = LogXxxEntry::create();

        $response = $this->listEntries([
            'table' => 'log_xxx_entries',
            'start_created_at' => now()->format('c'),
        ]);

        $response
            ->assertOk()
            ->assertViewHas('entries', function ($entries) use ($log1) {
                return !$entries->contains('id', $log1->id);
            })
            ->assertViewHas('entries', function ($entries) use ($log2) {
                return $entries->contains('id', $log2->id);
            });
    }

    public function test_日付の終点で絞り込む()
    {
        $log1 = LogXxxEntry::create();
        $this->travel(1)->seconds();
        $log2 = LogXxxEntry::create();

        $response = $this->listEntries([
            'table' => 'log_xxx_entries',
            'stop_created_at' => now()->format('c'),
        ]);

        $response
            ->assertOk()
            ->assertViewHas('entries', function ($entries) use ($log1) {
                return $entries->contains('id', $log1->id);
            })
            ->assertViewHas('entries', function ($entries) use ($log2) {
                return !$entries->contains('id', $log2->id);
            });
    }

    public function test_フィールドとキーワードで絞り込む()
    {
        $log1 = LogXxxEntry::create(['name' => 'abc']);
        $log2 = LogXxxEntry::create();

        $response = $this->listEntries([
            'table' => 'log_xxx_entries',
            'fields' => [['key' => 'name', 'query' => 'b']],
        ]);

        $response
            ->assertOk()
            ->assertViewHas('entries', function ($entries) use ($log1) {
                return $entries->contains('id', $log1->id);
            })
            ->assertViewHas('entries', function ($entries) use ($log2) {
                return !$entries->contains('id', $log2->id);
            });
    }

    public function test_ログ以外のテーブルにはアクセスできない()
    {
        $response = $this->listEntries(['table' => 'zzz_entries']);

        $response->assertStatus(400);
    }

    public function test_存在しないテーブルにはアクセスできない()
    {
        $response = $this->listEntries(['table' => 'log_some_entries']);

        $response->assertStatus(400);
    }

    public function test_テーブル名は必須()
    {
        $response = $this->listEntries(['table' => '']);

        $response->assertRedirect()->assertSessionHasErrors('table');
    }

    public function test_フィールドは配列のみ()
    {
        $response = $this->listEntries([
            'table' => 'log_xxx_entries',
            'fields' => 'abc',
        ]);

        $response->assertRedirect()->assertSessionHasErrors('fields');
    }

    private function listEntries($params = [])
    {
        return $this->actingAsSuperUser()->get(
            route('admin.logs.show', $params)
        );
    }
}
