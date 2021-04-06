<?php
namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Query\Services\MenuQueryService;

class Admin
{
    public function guard(): Guard
    {
        return Auth::guard(config('admin.guard'));
    }

    public function user(): ?Authenticatable
    {
        return $this->guard()->user();
    }

    public function routeGroup($fn)
    {
        Route::group($this->groupAttributes(), $fn);
    }

    public function menu()
    {
        if (!$this->guard()->check()) {
            return collect();
        }
        return (new MenuQueryService())->items($this->user())->toTree();
    }

    public function notifications($limit = null)
    {
        return optional($this->user(), function ($user) use ($limit) {
            return $user
                ->notifications()
                ->latest()
                ->take($limit)
                ->get();
        }) ?? collect();
    }

    public function unreadNotificationsCount()
    {
        return optional($this->user(), function ($user) {
            return $user->unreadNotifications()->count();
        }) ?? 0;
    }

    private function groupAttributes()
    {
        return [
            'prefix' => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];
    }
}
