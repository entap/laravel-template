<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\AgreementType;
use Illuminate\Http\Request;

class AgreementTypeAgreementController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AgreementType $agreementType)
    {
        return view('admin.agreements.create', [
            'type' => $agreementType,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AgreementType $agreementType)
    {
        $d = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $agreementType->agreements()->create($d);

        return redirect()->route('admin.agreement_types.show', $agreementType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgreementType $agreementType, Agreement $agreement)
    {
        $agreement->delete();

        return redirect()->route('admin.agreement_types.show', $agreementType);
    }
}
