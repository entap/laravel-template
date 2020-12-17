<?php
namespace App;

use App\Models\AuthProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasAuthProviders
{
    public function authProviders(): HasMany
    {
        return $this->hasMany(AuthProvider::class);
    }

    public function getProvider(string $name): ?AuthProvider
    {
        return $this->authProviders()
            ->where('name', $name)
            ->first();
    }

    public function saveProvider(string $name, string $code)
    {
        $this->authProviders()->updateOrCreate(
            ['name' => $name],
            ['name' => $name, 'code' => $code]
        );
    }

    public function removeProvider(string $name)
    {
        $this->authProviders()
            ->where('name', $name)
            ->delete();
    }

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
