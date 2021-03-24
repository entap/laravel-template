<?php

namespace Entap\Admin\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * メールの送信履歴
 */
class LogSentMailEntry extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'from', 'subject', 'body'];
}
