<?php

namespace App\Http\Controllers;

use App\Models\AgreementType;
use Illuminate\Http\Request;

class UserAgreementController extends Controller
{
    public function __invoke(Request $request, AgreementType $agreementType)
    {
        $user = $request->user();

        if ($request->expectsJson()) {
            return [
                'agreed' => $user->hasAgreed($agreementType),
            ];
        }
    }
}
