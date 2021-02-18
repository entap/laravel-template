<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

/**
 * 仮登録したユーザー
 */
class TemporaryUser extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'email'];

    public function rejectedTemporaryUsers()
    {
        return $this->hasMany(RejectedTemporaryUser::class);
    }

    /**
     * 承認待ち
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->doesntHave('rejectedTemporaryUsers');
    }
}
