<?php
namespace App\Query\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class UserQueryService
{
    public function query(array $options = []): Builder
    {
        $query = User::query();
        if (isset($options['name'])) {
            $query = $query->where(
                'name',
                'LIKE',
                '%' . $options['name'] . '%'
            );
        }
        if (isset($options['email'])) {
            // TODO uniq貼ってるから前方一致でもいいかも
            $query = $query->where(
                'email',
                'LIKE',
                '%' . $options['email'] . '%'
            );
        }
        if (isset($options['start_created_at'])) {
            $query = $query->where(
                'created_at',
                '>=',
                Carbon::parse($options['start_created_at'])
            );
        }
        if (isset($options['stop_created_at'])) {
            $query = $query->where(
                'created_at',
                '<',
                Carbon::parse($options['stop_created_at'])
            );
        }
        return $query;
    }
}
