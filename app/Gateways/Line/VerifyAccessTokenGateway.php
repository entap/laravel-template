<?php
namespace App\Gateways\Line;

use InvalidArgumentException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Line\ConnectionError;
use App\Exceptions\Line\InvalidTokenException;

class VerifyAccessTokenGateway
{
    protected $clientId;

    public function __construct()
    {
        $this->setClientId(config('services.line.client_id'));
    }

    /**
     * アクセストークンを検証する
     */
    public function verify(string $accessToken): Response
    {
        $response = $this->getVerify($accessToken);
        $this->verifyResponse($response);

        return $response;
    }

    protected function verifyResponse(Response $response)
    {
        if (
            !$this->isValidToken(
                $response->json('client_id'),
                $response->json('expires_in')
            )
        ) {
            throw new InvalidTokenException();
        }
    }

    protected function isValidToken(string $clientId, int $expiresIn)
    {
        return $clientId === $this->clientId && $expiresIn > 0;
    }

    /**
     * LINEに問い合わせてアクセストークンの有効性を検証する
     *
     * https://developers.line.biz/ja/reference/line-login/#verify-access-token
     */
    protected function getVerify(string $accessToken)
    {
        $response = Http::asForm()->get($this->url(), [
            'access_token' => $accessToken,
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

    protected function setClientId(string $clientId)
    {
        if (empty($clientId)) {
            throw new InvalidArgumentException('LINE Client ID is required.');
        }
        $this->clientId = $clientId;
    }
}
