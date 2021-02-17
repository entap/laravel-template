<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ユーザーの保存された検索条件
 */
class UserSegment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'filter'];

    protected $casts = [
        'filter' => 'json',
    ];
}
