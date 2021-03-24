<?php
namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
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
