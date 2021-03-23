<?php
namespace App\Gateways\Line;

use Illuminate\Support\Facades\Http;
use App\Exceptions\Line\ConnectionError;

class GetUserIdGateway
{
    /**
     * ユーザーIDを取得する
     */
    public function getUserId(string $accessToken): string
    {
        $response = $this->getProfile($accessToken);
        return $response->json('userId');
    }

    /**
     * ユーザープロフィールを取得する
     *
     * https://developers.line.biz/ja/reference/line-login/#get-user-profile
     */
    protected function getProfile(string $accessToken)
    {
        $response = Http::asForm()
            ->withHeaders([
                'Authorization' => "Bearer {$accessToken}",
            ])
            ->get($this->url());

        if ($response->failed()) {
            throw new ConnectionError();
        }

        return $response;
    }

    protected function url()
    {
        return 'https://api.line.me/v2/profile';
    }
}
