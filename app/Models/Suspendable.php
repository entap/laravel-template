<?php
namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Suspendable
{
    /**
     * 凍結する
     */
    public function suspend(
        string $reason = null,
        Carbon $suspendedAt = null
    ): void {
        $this->suspending_reason = $reason;
        $this->suspended_at = $suspendedAt ?? now();
        $this->save();
    }

    /**
     * 指定した時間に凍結を解除する
     */
    public function unsuspendAt(Carbon $expiresAt): void
    {
        $this->suspending_expires_at = $expiresAt;
        $this->save();
    }

    /**
     * 凍結を解除する
     */
    public function unsuspend(): void
    {
        $this->suspending_reason = null;
        $this->suspending_expires_at = null;
        $this->suspended_at = null;
        $this->save();
    }

    /**
     * 凍結された
     */
    public function scopeSuspended(Builder $query, Carbon $now = null): Builder
    {
        return $query
            ->whereNotNull('suspended_at')
            ->where('suspending_expires_at', '>', $now ?? now());
    }

    /**
     * 凍結されていない
     */
    public function scopeUnsuspended(Builder $query): Builder
    {
        return $query->whereNull('suspended_at');
    }
}
