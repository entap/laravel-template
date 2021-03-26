<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\DynamicCategoryCreated;
use App\Events\Admin\DynamicCategoryDeleted;
use App\Events\Admin\DynamicCategoryUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\DynamicCategory;
use App\Models\DynamicPage;
use Illuminate\Support\Facades\DB;

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
        $parentOptions = DynamicCategory::all();
        $pageOptions = DynamicPage::all();

        return view(
            'admin.dynamic_categories.create',
            compact('parentOptions', 'pageOptions')
        );
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
            'parent_id' => 'nullable|exists:dynamic_categories,id',
            'pages' => 'sometimes|array',
            'pages.*' => 'required|exists:dynamic_pages,id',
        ]);
        $pages = $request->input('pages');

        $category = DB::transaction(function () use ($d, $pages) {
            $category = DynamicCategory::create($d);
            $category->pages()->sync($pages);
            return $category;
        });

        event(new DynamicCategoryCreated(request()->user(), $category));

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
        $parentOptions = DynamicCategory::where(
            'id',
            '<>',
            $dynamicCategory->id
        )->get();
        $pageOptions = DynamicPage::all();

        return view('admin.dynamic_categories.edit', [
            'category' => $dynamicCategory,
            'parentOptions' => $parentOptions,
            'pageOptions' => $pageOptions,
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
            'parent_id' => 'nullable|exists:dynamic_categories,id',
            'pages' => 'sometimes|array',
            'pages.*' => 'required|exists:dynamic_pages,id',
        ]);
        $pages = $request->input('pages');

        DB::transaction(function () use ($dynamicCategory, $d, $pages) {
            $dynamicCategory->update($d);
            $dynamicCategory->pages()->sync($pages);
        });

        event(new DynamicCategoryUpdated(request()->user(), $dynamicCategory));

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

        event(new DynamicCategoryDeleted(request()->user(), $dynamicCategory));

        return redirect()->route('admin.dynamic-categories.index');
    }
}
