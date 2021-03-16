<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 管理者の操作ログ
 */
class LogAdminActionEntry extends Model
{
    use HasFactory;

    protected $fillable = ['action', 'note'];
}
