<?php
namespace App\Gateways\Git;

class CurrentVersionGateway
{
    /**
     * 現在のバージョンを取得する
     */
    public function version()
    {
        return `git describe --tags`;
    }
}
