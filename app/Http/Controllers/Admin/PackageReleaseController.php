<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageRelease;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class PackageReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Package $package)
    {
        return view('admin.packages.releases.create', $package);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Package $package)
    {
        $request->validate([
            'version' => ['required', 'string', 'max:255'],
            'uri' => ['nullable', 'url', 'max:1000'],
            'publish_date' => ['nullable', 'date'],
            'expire_date' => ['nullable', 'date'],
        ]);

        $package->releases()->create([
            'version' => $request->input('version'),
            'uri' => $request->input('uri'),
            'publish_date' =>
                $request->input('publish_date') ?? '0000-01-01 00:00:00',
            'expire_date' =>
                $request->input('expire_date') ?? '9999-12-31 23:59:59',
        ]);

        return redirect()->route('admin.packages.show', $package);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageRelease  $packageRelease
     * @return \Illuminate\Http\Response
     */
    public function show(PackageRelease $packageRelease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageRelease  $packageRelease
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageRelease $packageRelease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageRelease  $packageRelease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageRelease $packageRelease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageRelease  $packageRelease
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageRelease $packageRelease)
    {
        //
    }
}
