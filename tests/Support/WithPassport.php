<?php
namespace Tests\Support;

use Laravel\Passport\ClientRepository;

trait WithPassport
{
    /**
     * パーソナルアクセスクライアントを作成する
     */
    public function createPersonalAccessClient()
    {
        $clientRepository = new ClientRepository();
        return $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            '/'
        );
    }
}
