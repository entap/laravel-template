<?php

namespace App\Http\Controllers\Auth\Line;

use App\Models\User;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Entap\OAuth\Line\Application\Services\VerifyService;

class LoginController extends Controller
{
    protected $line;

    public function __construct(VerifyService $line)
    {
        $this->line = $line;
    }

    public function __invoke(Request $request)
    {
        $verifiedToken = $this->line->verify($request);

        $uid = $verifiedToken->userId();
        $user = User::withProvider('line', $uid)->first();

        if (empty($user)) {
            $user = DB::transaction(function () use ($uid) {
                $user = User::create();
                try {
                    $user->saveProvider('line', $uid);
                } catch (InvalidArgumentException $e) {
                    abort(400, $e->getMessage());
                }
            });
        }

        $token = $user->createToken('LINE Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }
}
