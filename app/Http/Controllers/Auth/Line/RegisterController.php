<?php

namespace App\Http\Controllers\Auth\Line;

use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Http\Controllers\Controller;
use App\Services\Line\VerifyService;

class RegisterController extends Controller
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
        $user = $request->user();

        try {
            $user->saveProvider('line', $uid);
        } catch (InvalidArgumentException $e) {
            abort(400, $e->getMessage());
        }
    }
}
