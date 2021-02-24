<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
use App\Models\DynamicCategory;

class DynamicCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DynamicCategory::withDepth()
            ->get()
            ->toFlatTree();

        return view('admin.dynamic_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dynamic_categories.create');
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
            'name' => 'required|string|max:255',
        ]);

        DynamicCategory::create($d);

        return redirect()->route('admin.dynamic-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DynamicCategory $dynamicCategory)
    {
        return view('admin.dynamic_categories.show', [
            'category' => $dynamicCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DynamicCategory $dynamicCategory)
    {
        return view('admin.dynamic_categories.edit', [
            'category' => $dynamicCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DynamicCategory $dynamicCategory)
    {
        $d = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $dynamicCategory->update($d);

        return redirect()->route('admin.dynamic-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DynamicCategory $dynamicCategory)
    {
        $dynamicCategory->delete();

        return redirect()->route('admin.dynamic-categories.index');
    }
}
