<?php

namespace Entap\Admin\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ログイン履歴
 */
class LogLoginEntry extends Model
{
    use HasFactory;

    protected $fillable = ['host', 'user_id', 'user_type', 'user_agent'];
}
