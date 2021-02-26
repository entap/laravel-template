<?php

namespace App\Http\Controllers;

use App\Models\AgreementType;
use Illuminate\Http\Request;
use InvalidArgumentException;

class UserAgreeController extends Controller
{
    public function __invoke(Request $request, AgreementType $agreementType)
    {
        if (empty($agreementType->agreements()->count())) {
            throw new InvalidArgumentException('契約が設定されていません。');
        }

        $user = $request->user();
        $agreement = $agreementType
            ->agreements()
            ->latest()
            ->first();
        $user->agreements()->syncWithoutDetaching([$agreement->id]);

        if ($request->expectsJson()) {
            return response()->noContent();
        }
    }
}
