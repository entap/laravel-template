<?php

namespace App\Http\Controllers\Settings;

use App\Gateways\Git\CurrentVersionGateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    protected $git;

    public function __construct(CurrentVersionGateway $git)
    {
        $this->git = $git;
    }

    /**
     * サーバーのバージョンを取得する
     */
    public function __invoke()
    {
        return [
            'version' => $this->git->version(),
        ];
    }
}
