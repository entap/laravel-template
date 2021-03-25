<?php

namespace App\Http\Controllers\Auth\Line;

use App\Events\Auth\Line\Login;
use App\Models\User;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Auth\Line\VerifyService;
use Illuminate\Contracts\Auth\Authenticatable;

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
                return $user;
            });
        }

        $token = $user->createToken('LINE Token');

        $this->didLogin($user);

        return [
            'access_token' => $token->accessToken,
        ];
    }

    protected function didLogin(Authenticatable $user)
    {
        event(new Login('api', $user));
    }
}
