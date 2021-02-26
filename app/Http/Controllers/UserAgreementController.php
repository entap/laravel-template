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
                'status' => $user->hasAgreed($agreementType) ? 'agreed' : '',
                'agreement_id' => optional(
                    $user
                        ->agreements()
                        ->where('agreement_type_id', $agreementType->id)
                        ->latest()
                        ->first()
                )->id,
            ];
        }
    }
}
