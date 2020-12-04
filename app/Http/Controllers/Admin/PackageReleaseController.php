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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Package $package)
    {
        return view('admin.packages.releases.create', compact('package'));
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

        // TODO dateは必須にしてビューから渡す方がいいかも
        $package->releases()->create([
            'version' => $request->input('version'),
            'uri' => $request->input('uri'),
            'publish_date' =>
                $request->input('publish_date') ?? '0001-01-01 00:00:00',
            'expire_date' =>
                $request->input('expire_date') ?? '9999-12-31 23:59:59',
        ]);

        return redirect()->route('admin.packages.show', $package);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageRelease  $release
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package, PackageRelease $release)
    {
        return view('admin.packages.releases.edit', [
            'package' => $package,
            'release' => $release,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageRelease  $release
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Package $package,
        PackageRelease $release
    ) {
        $request->validate([
            'version' => ['required', 'string', 'max:255'],
            'uri' => ['nullable', 'url', 'max:1000'],
            'publish_date' => ['required', 'date'],
            'expire_date' => ['required', 'date'],
        ]);

        $release->update($request->all());

        return redirect()->route('admin.packages.show', $package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageRelease  $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package, PackageRelease $release)
    {
        $release->delete();

        return redirect()->route('admin.packages.show', $package);
    }
}
