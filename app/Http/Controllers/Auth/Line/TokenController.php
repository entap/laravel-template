<?php

namespace App\Http\Controllers\Auth\Line;

use App\Gateways\Line\VerifyIdTokenGateway;
use App\Http\Controllers\Controller;
use App\Models\AuthProvider;
use App\Models\LineNonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
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
            // 'nonce_id' => 'required|exists:line_nonces,id',
        ]);

        // $nonce = LineNonce::find($request->input('nonce_id'));
        // $nonce->delete();

        $verifiedIdToken = $this->line->verify(
            $request->input('id_token')
            // $nonce->nonce
        );
        // TODO 失敗したら400か401あたりで返そう

        $uid = $verifiedIdToken['sub'];

        // TODO ここからサービスにまとめる
        $provider = AuthProvider::where('name', 'line')
            ->where('code', $uid)
            ->first();
        if ($provider) {
            $user = $provider->user;
        } else {
            $user = DB::transaction(function () use ($uid) {
                // TODO User作るのアプリケーション依存なので共通化できない
                // 見つからないときはエラーにしてregisterしてもらう？
                $user = User::create();

                $user->authProviders()->create([
                    'name' => 'line',
                    'code' => $uid,
                ]);

                return $user;
            });
        }
        // --- ここまで

        $token = $user->createToken('LINE Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
