<?php

namespace Entap\Admin\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * APIリクエスト履歴
 */
class LogRequestEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'host',
        'method',
        'action',
        'status',
        'request_body',
        'response_body',
        'user_id',
        'device',
        'device_brand',
        'platform',
        'platform_version',
        'package_name',
        'package_version',
    ];
}
