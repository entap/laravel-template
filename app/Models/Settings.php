<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 設定
 *
 * app('settings') か Settings ファサードから使う
 */
class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['welcome_message'];
}
