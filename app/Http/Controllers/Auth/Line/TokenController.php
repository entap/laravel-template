<?php

namespace App\Http\Controllers\Auth\Line;

use App\Gateways\Line\VerifyIdTokenGateway;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use UserCreateToken;

class SignInController extends Controller
{
    protected $line;
    protected $tokens;

    public function __construct(
        VerifyIdTokenGateway $line,
        UserCreateToken $tokens
    ) {
        $this->line = $line;
        $this->tokens = $tokens;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
            // 'nonce_id' => 'required',
        ]);

        // TODO nonce_idとnonceを記録しておいてとってくる
        // $nonce = '';

        $verifiedIdToken = $this->line->verify(
            $request->input('id_token')
            // ,$nonce
        );
        // TODO 失敗したら400か401あたりで返そう

        // TODO 成功でも失敗でもnonceを削除する

        $uid = $verifiedIdToken['sub'];

        $user = User::where('line_id', $uid)->firstOrCreate([
            'line_id' => $uid,
        ]);
        $$token = $user->createToken('LINE Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
