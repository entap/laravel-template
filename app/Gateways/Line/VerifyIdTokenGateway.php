<?php
namespace App\Gateways\Line;

use Exception;
use Illuminate\Support\Facades\Http;

class VerifyIdTokenGateway
{
    public function verify(string $idToken, string $nonce = '')
    {
        $clientId = config('services.line.client_id');
        // TODO CLIENT_IDが設定されてないとエラー

        $response = $this->postVerify($idToken, $clientId, $nonce);
        if (!$response->successful()) {
            // TODO エラー
            throw new Exception('connection error: ' . $response->status());
        }
        if ($error = $response->json('error')) {
            $errorDescription = $response->json('error_description');
            // TODO エラー
            throw new Exception('line error: ' . $error);
        }
        return $response->json();
    }

    private function postVerify(
        string $idToken,
        string $clientId,
        string $nonce = ''
    ) {
        return Http::asForm()->post($this->url(), [
            'id_token' => $idToken,
            'client_id' => $clientId,
            // 'nonce' => $nonce,
        ]);
    }

    private function url()
    {
        return 'https://api.line.me/oauth2/v2.1/verify';
    }
}

// References
//
// https://developers.line.biz/ja/reference/line-login/
// https://developers.line.biz/ja/docs/line-login/secure-login-process/
