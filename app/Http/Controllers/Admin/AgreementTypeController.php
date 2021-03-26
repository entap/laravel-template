<?php

namespace App\Http\Controllers\Admin;

use App\Events\AgreementTypeCreated;
use App\Events\AgreementTypeDeleted;
use App\Events\AgreementTypeUpdated;
use App\Http\Controllers\Controller;
use App\Models\AgreementType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgreementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = AgreementType::latest()->get();

        return view('admin.agreements.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agreements.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = $request->validate([
            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('agreement_types'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'confirmation_mode' => ['nullable', 'string', 'in:strict'],
        ]);
        $type = AgreementType::create($d);

        event(new AgreementTypeCreated(request()->user(), $type));

        return redirect()->route('admin.agreement_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AgreementType  $agreementType
     * @return \Illuminate\Http\Response
     */
    public function show(AgreementType $agreementType)
    {
        $agreements = $agreementType
            ->agreements()
            ->latest()
            ->get();

        return view('admin.agreements.types.show', [
            'type' => $agreementType,
            'agreements' => $agreements,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AgreementType  $agreementType
     * @return \Illuminate\Http\Response
     */
    public function edit(AgreementType $agreementType)
    {
        return view('admin.agreements.types.edit', [
            'type' => $agreementType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AgreementType  $agreementType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgreementType $agreementType)
    {
        $d = $request->validate([
            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('agreement_types')->ignore($agreementType),
            ],
            'name' => ['required', 'string', 'max:255'],
            'confirmation_mode' => ['nullable', 'string', 'in:strict'],
        ]);

        $agreementType->update($d);

        event(new AgreementTypeUpdated(request()->user(), $agreementType));

        return redirect()->route('admin.agreement_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgreementType  $agreementType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgreementType $agreementType)
    {
        $agreementType->delete();

        event(new AgreementTypeDeleted(request()->user(), $agreementType));

        return redirect()->route('admin.agreement_types.index');
    }
}
