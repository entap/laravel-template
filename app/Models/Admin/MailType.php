<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * メール種別
 */
class MailType extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description'];

    public function templates()
    {
        return $this->hasMany(MailTemplate::class);
    }

    public function scopeOfCode(Builder $query, string $code)
    {
        return $query->where('code', $code);
    }
}
