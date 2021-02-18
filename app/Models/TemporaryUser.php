<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 仮登録したユーザー
 */
class TemporaryUser extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function rejectedTemporaryUsers()
    {
        return $this->hasMany(RejectedTemporaryUser::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->doesntHave(RejectedTemporaryUser::class);
    }
}
