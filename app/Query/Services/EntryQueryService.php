<?php
namespace App\Query\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EntryQueryService
{
    public function query(string $tableName, $options = [])
    {
        $query = DB::table($tableName);

        if (!empty($options['start_created_at'])) {
            $query = $query->where(
                'created_at',
                '>=',
                Carbon::parse($options['start_created_at'])
            );
        }

        if (!empty($options['stop_created_at'])) {
            $query = $query->where(
                'created_at',
                '<',
                Carbon::parse($options['stop_created_at'])
            );
        }

        if (!empty($options['fields'])) {
            foreach ($options['fields'] as $field) {
                if (empty($field['key']) || empty($field['query'])) {
                    continue;
                }
                $query = $query->where(
                    $field['key'],
                    'LIKE',
                    '%' . $field['query'] . '%'
                );
            }
        }

        return $query;
    }
}
