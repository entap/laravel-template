<?php

namespace App\Http\Controllers\Auth\Line;

use App\Models\LineNonce;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NonceController extends Controller
{
    public function __invoke()
    {
        return LineNonce::create([
            'nonce' => Str::uuid(),
        ]);
    }
}
