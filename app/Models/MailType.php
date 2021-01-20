<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
