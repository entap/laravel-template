<?php

namespace App\Http\Controllers\Auth\Line;

use App\Gateways\Line\VerifyIdTokenGateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
            // TODO nonceをオプションで使えるようにする
            // 'nonce_id' => 'required',
        ]);

        $user = $request->user();
        $idToken = $request->input('id_token');

        // TODO nonceを使う
        // nonceがないとクライアントを信用できない
        $verifyedIdToken = $this->line->verify($idToken);
        // TODO 失敗したら400か401あたりで返そう

        $uid = $verifyedIdToken['sub'];

        $user
            ->authProviders()
            ->updateOrCreate(
                ['name' => 'line'],
                ['name' => 'line', 'code' => $uid]
            );

        // TODO nonceを削除する (userとは別のトランザクションでいい)
    }
}
