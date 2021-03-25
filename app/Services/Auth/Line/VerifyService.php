<?php
namespace App\Services\Auth\Line;

use Illuminate\Http\Request;
use App\Services\Auth\Line\VerifiedToken;
use App\Gateways\Line\GetUserIdGateway;
use App\Gateways\Line\VerifyIdTokenGateway;
use App\Exceptions\Line\InvalidTokenException;
use App\Gateways\Line\VerifyAccessTokenGateway;

class VerifyService
{
    /**
     * トークンを検証する
     */
    public function verify(Request $request): VerifiedToken
    {
        if ($request->has('id_token')) {
            return $this->verifyIdToken($request);
        }
        if ($request->has('access_token')) {
            return $this->verifyAccessToken($request);
        }
        abort(400, 'Invalid Request');
    }

    protected function verifyIdToken(Request $request): VerifiedToken
    {
        $request->validate([
            'id_token' => 'required',
            'nonce' => 'nullable',
        ]);
        $idToken = $request->input('id_token');
        $nonce = $request->input('nonce');

        $verifyGateway = new VerifyIdTokenGateway();
        try {
            $response = $verifyGateway->verify($idToken, $nonce);
        } catch (InvalidTokenException $e) {
            abort(400, $e->getMessage());
        }

        return new VerifiedToken($response->json('sub'));
    }

    protected function verifyAccessToken(Request $request): VerifiedToken
    {
        $request->validate([
            'access_token' => 'required',
        ]);
        $accessToken = $request->input('access_token');

        $verifyGateway = new VerifyAccessTokenGateway();
        try {
            $verifyGateway->verify($accessToken);
        } catch (InvalidTokenException $e) {
            abort(400, $e->getMessage());
        }

        $userGateway = new GetUserIdGateway();
        return new VerifiedToken($userGateway->getUserId($accessToken));
    }
}
