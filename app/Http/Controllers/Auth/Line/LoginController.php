<?php

namespace App\Http\Controllers\Auth\Line;

use App\Http\Controllers\Controller;
use App\Models\User;
use Entap\OAuth\Line\Application\Gateways\VerifyIdTokenGateway;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $line;

    public function __construct(VerifyIdTokenGateway $line)
    {
        $this->line = $line;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $uid = $this->line->verify($request->input('id_token'));

        $user = User::withProvider('line', $uid)->firstOrCreate();
        $user->saveProvider('line', $uid);

        $token = $user->createToken('LINE Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
