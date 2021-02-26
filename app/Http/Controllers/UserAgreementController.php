<?php

namespace App\Http\Controllers;

use App\Models\AgreementType;
use Illuminate\Http\Request;

class UserAgreementController extends Controller
{
    public function __invoke(Request $request, AgreementType $agreementType)
    {
        $user = $request->user();
        // TODO 新しいバージョンがあった場合は同意してない状態にしたい
        $agreement = $user
            ->agreements()
            ->where('agreement_type_id', $agreementType->id)
            ->count();

        if ($request->expectsJson()) {
            return [
                'agreed' => !!$agreement,
            ];
        }
    }
}
