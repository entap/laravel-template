<?php
namespace Entap\Admin\Application\Query\Service;

use Entap\Admin\Database\Models\UserGroup;
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
