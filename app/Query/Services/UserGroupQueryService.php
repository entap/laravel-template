<?php
namespace App\Query\Services;

use App\Models\Admin\UserGroup;
use Illuminate\Database\Eloquent\Builder;

/**
 * ユーザーグループの検索サービス
 */
class UserGroupQueryService
{
    public function query(array $options = []): Builder
    {
        $query = UserGroup::query();

        if (isset($options['name'])) {
            $query->where('name', $options['name']);
        }

        return $query;
    }
}
