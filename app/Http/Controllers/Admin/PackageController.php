<?php

namespace App\Http\Controllers\Admin;

use App\Events\PackageCreated;
use App\Events\PackageDeleted;
use App\Events\PackageUpdated;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages'),
            ],
        ]);

        $package = Package::create($request->all());

        event(new PackageCreated(request()->user(), $package));

        return redirect()->route('admin.packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $releases = $package
            ->releases()
            ->latest('publish_date')
            ->get();
        return view('admin.packages.show', compact('package', 'releases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages')->ignore($package->id),
            ],
        ]);

        $package->update($request->all());

        event(new PackageUpdated(request()->user(), $package));

        return redirect()->route('admin.packages.show', $package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->releases()->delete();
        $package->delete();

        event(new PackageDeleted(request()->user(), $package));

        return redirect()
            ->route('admin.packages.index')
            ->with('success', "{$package->name} has deleted.");
    }
}
