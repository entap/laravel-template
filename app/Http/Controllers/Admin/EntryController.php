<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Schema;
use App\Query\Services\EntryQueryService;

class EntryController extends Controller
{
    private $entries;

    public function __construct(EntryQueryService $entries)
    {
        $this->entries = $entries;
    }

    public function index(Request $request)
    {
        $request->validate([
            'table' => 'required',
            'start_created_at' => 'nullable|date',
            'stop_created_at' => 'nullable|date',
            'fields' => 'array',
            'fields.*' => 'array',
        ]);

        $tableName = $request->input('table');

        if (!Str::is(config('logs.include'), $tableName)) {
            abort(400, 'ログのテーブルではありません。');
        }

        if (!Schema::hasTable($tableName)) {
            abort(400, 'テーブルが存在しません。');
        }

        $columns = DB::getDoctrineSchemaManager()->listTableColumns($tableName);
        $entries = $this->entries
            ->query($tableName, $request->all())
            ->paginate();

        return view(
            'admin.logs.entries.index',
            compact('tableName', 'columns', 'entries')
        );
    }
}
