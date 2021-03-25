<?php
namespace App\Query\Services;

use App\Models\Admin\MenuItem;
use App\Models\Admin\User;
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
