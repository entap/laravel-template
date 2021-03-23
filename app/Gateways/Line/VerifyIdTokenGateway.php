<?php
namespace App\Gateways\Line;

use InvalidArgumentException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Line\ConnectionError;
use App\Exceptions\Line\InvalidTokenException;

class VerifyIdTokenGateway
{
    protected $clientId;

    public function __construct()
    {
        $this->setClientId(config('services.line.client_id'));
    }

    /**
     * IDトークンを検証する
     */
    public function verify(string $idToken, string $nonce = null): Response
    {
        return $this->postVerify($idToken, $nonce);
    }

    /**
     * LINEに問い合わせてIDトークンを検証する
     *
     * https://developers.line.biz/ja/reference/line-login/#verify-id-token
     * https://developers.line.biz/ja/docs/line-login/secure-login-process/
     */
    protected function postVerify(string $idToken, string $nonce = null)
    {
        $response = Http::asForm()->post($this->url(), [
            'client_id' => $this->clientId,
            'id_token' => $idToken,
            'nonce' => $nonce,
        ]);

        if ($response->status() === 400) {
            throw new InvalidTokenException(
                $response->json('error_description')
            );
        }

        if ($response->failed()) {
            throw new ConnectionError();
        }

        return $response;
    }

    protected function url()
    {
        return 'https://api.line.me/oauth2/v2.1/verify';
    }

    protected function setClientId($clientId)
    {
        if (empty($clientId)) {
            throw new InvalidArgumentException('LINE Client ID is required.');
        }
        $this->clientId = $clientId;
    }
}
