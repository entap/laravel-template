<?php

namespace App\Http\Controllers\Auth\Firebase;

use App\Http\Controllers\Controller;
use App\Models\User;
use Entap\OAuth\Firebase\Application\Gateways\Firebase\VerifyIdTokenGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class LoginController extends Controller
{
    protected $firebase;

    public function __construct(VerifyIdTokenGateway $firebase)
    {
        $this->firebase = $firebase;
    }

    function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $idToken = $request->input('id_token');

        $verifiedToken = $this->firebase->verify($idToken);
        $uid = $verifiedToken->userId();
        $user = User::withProvider('firebase', $uid)->first();

        if (empty($user)) {
            $user = DB::transaction(function () use ($uid) {
                $user = User::create();
                try {
                    $user->saveProvider('firebase', $uid);
                } catch (InvalidArgumentException $e) {
                    abort(400, $e->getMessage());
                }
                return $user;
            });
        }

        $token = $user->createToken('Firebase Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
