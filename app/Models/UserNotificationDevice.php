<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationDevice extends Model
{
    use HasFactory;

    protected $fillable = ['token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHasToken(Builder $query, string $token): Builder
    {
        return $query->where('token', $token);
    }
}
