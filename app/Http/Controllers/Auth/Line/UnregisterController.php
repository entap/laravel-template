<?php

namespace App\Http\Controllers\Auth\Line;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnregisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->removeProvider('line');
    }
}
