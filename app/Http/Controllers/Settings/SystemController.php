<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * サーバーのバージョンを取得する
     */
    public function __invoke()
    {
        return [
            'version' => `git describe --tags`,
        ];
    }
}
