<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 詳細
     */
    public function show(Request $request)
    {
        return $request->user();
    }
}
