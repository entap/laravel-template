<?php
namespace Entap\Admin\Application\Query\Service;

use Entap\Admin\Database\Models\MenuItem;
use Entap\Admin\Database\Models\User;
use Illuminate\Support\Collection;

class MenuQueryService
{
    public function items(User $user): Collection
    {
        $items = MenuItem::all();
        return $items->filter(function ($item) use ($user) {
            return empty($item->uri) || $user->hasOperation('get', $item->uri);
        });
    }
}
