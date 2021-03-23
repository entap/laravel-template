<?php

namespace App\Http\Controllers\Auth\Line;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnregisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->removeProvider('line');
    }
}
