<?php

namespace App\Http\Controllers;

use App\Models\UserOpinion;
use Illuminate\Http\Request;

class SendOpinionController extends Controller
{
    /**
     * 問い合わせを送る
     */
    public function send(Request $request)
    {
        $user = $request->user();
        $d = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $opinion = UserOpinion::create([
            'subject' => $d['subject'],
            'body' => $d['body'],
            'user_id' => $user->id,
        ]);

        if ($request->expectsJson()) {
            return $opinion;
        }
    }
}
