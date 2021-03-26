<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Query\Services\EntryQueryService;
use App\Query\Services\TableQueryService;
use App\Http\Controllers\Admin\Controller;

class LogController extends Controller
{
    protected $tables;
    protected $entries;

    public function __construct(
        TableQueryService $tables,
        EntryQueryService $entries
    ) {
        $this->tables = $tables;
        $this->entries = $entries;
    }

    /**
     * テーブル一覧
     */
    public function index()
    {
        $tables = $this->tables->all();

        return view('admin.logs.index', compact('tables'));
    }

    /**
     * レコード一覧
     */
    public function show(Request $request)
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
