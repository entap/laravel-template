<?php
namespace App\Models;

use App\Models\AuthProvider;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasAuthProviders
{
    /**
     * 連携している認証プロバイダ
     */
    public function authProviders(): HasMany
    {
        return $this->hasMany(AuthProvider::class);
    }

    /**
     * 認証連携を取得する
     */
    public function getProvider(string $name): ?AuthProvider
    {
        return $this->authProviders()
            ->where('name', $name)
            ->first();
    }

    /**
     * 認証連携を登録する
     */
    public function saveProvider(string $name, string $code): void
    {
        if (
            static::withProvider($name, $code)
                ->where('id', '<>', $this->id)
                ->count() > 0
        ) {
            throw new InvalidArgumentException(
                'すでに他のアカウントで使われています。'
            );
        }

        $this->authProviders()->updateOrCreate(
            ['name' => $name],
            ['name' => $name, 'code' => $code]
        );
    }

    /**
     * 認証連携を解除する
     */
    public function removeProvider(string $name): void
    {
        $this->authProviders()
            ->where('name', $name)
            ->delete();
    }

    /**
     * 認証連携を絞り込む
     */
    public function scopeWithProvider(
        Builder $query,
        string $name,
        string $code
    ): Builder {
        return $query->whereHas('authProviders', function ($q) use (
            $name,
            $code
        ) {
            return $q->where('name', $name)->where('code', $code);
        });
    }
}
