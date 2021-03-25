<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Query\Services\TableQueryService;

class TableController extends Controller
{
    private $tables;

    public function __construct(TableQueryService $tables)
    {
        $this->tables = $tables;
    }

    public function index()
    {
        $tables = $this->tables->all();

        return view('admin.logs.index', compact('tables'));
    }
}
