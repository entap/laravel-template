<?php
namespace App\Gateways\Line;

use Exception;
use Illuminate\Support\Facades\Http;

class VerifyIdTokenGateway
{
    protected $clientId;

    public function __construct()
    {
        $this->setClientId(config('services.line.client_id'));
    }

    public function verify(string $idToken, string $nonce = '')
    {
        $response = $this->postVerify($idToken, $nonce);
        if (!$response->successful()) {
            // TODO エラー
            throw new Exception('connection error: ' . $response->status());
        }
        if ($error = $response->json('error')) {
            $errorDescription = $response->json('error_description');
            // TODO エラー
            // こっちは普通に起きるのでエラーレスポンスみたいにしたい。
            throw new Exception('line error: ' . $error);
        }
        $jsonData = $response->json();
        $uid = $jsonData['sub'];

        return $uid;
    }

    protected function postVerify(string $idToken, string $nonce = '')
    {
        return Http::asForm()->post($this->url(), [
            'client_id' => $this->clientId,
            'id_token' => $idToken,
            // 'nonce' => $nonce,
        ]);
    }

    protected function url()
    {
        return 'https://api.line.me/oauth2/v2.1/verify';
    }

    protected function setClientId($clientId)
    {
        if (empty($clientId)) {
            throw new Exception('LINE Client ID is required.');
        }
        $this->clientId = $clientId;
    }
}

// References
//
// https://developers.line.biz/ja/reference/line-login/
// https://developers.line.biz/ja/docs/line-login/secure-login-process/
