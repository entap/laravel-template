<?php
namespace App\Query\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TableQueryService
{
    public function all()
    {
        return collect(DB::getDoctrineSchemaManager()->listTables())->filter(
            function ($table) {
                return Str::is(config('logs.include'), $table->getName());
            }
        );
    }
}
