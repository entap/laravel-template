<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\DynamicPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DynamicPageController extends Controller
{
    public function index()
    {
        $pages = DynamicPage::with('contents')
            ->latest('updated_at')
            ->get();

        return view('admin.dynamic_pages.index', compact('pages'));
    }

    public function show(DynamicPage $dynamicPage)
    {
        $contents = $dynamicPage
            ->contents()
            ->latest()
            ->get();
        return view('admin.dynamic_pages.show', [
            'page' => $dynamicPage,
            'contents' => $contents,
        ]);
    }

    public function create()
    {
        return view('admin.dynamic_pages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slug' => 'required|string|alpha_dash|max:255|unique:dynamic_pages',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'cover' => 'nullable|file|mimes:jpg,png',
        ]);
        $cover = $request->file('cover');

        $page = DB::transaction(function () use ($validatedData, $cover) {
            $page = DynamicPage::create([
                'slug' => $validatedData['slug'],
            ]);
            $content = $page->contents()->create([
                'subject' => $validatedData['subject'],
                'body' => $validatedData['body'],
            ]);
            if ($cover) {
                $path = $cover->store('covers', 'public');
                $content->cover = $path;
                $content->save();
            }

            return $page;
        });

        return redirect()->route('admin.dynamic-pages.show', $page);
    }

    public function edit(DynamicPage $dynamicPage)
    {
        $content = $dynamicPage
            ->contents()
            ->latest()
            ->firstOrNew();

        return view(
            'admin.dynamic_pages.edit',
            compact('dynamicPage', 'content')
        );
    }

    public function update(Request $request, DynamicPage $dynamicPage)
    {
        $validatedData = $request->validate([
            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('dynamic_pages')->ignore($dynamicPage),
            ],
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'cover' => 'nullable|file|mimes:jpg,png',
        ]);
        $cover = $request->file('cover');

        DB::transaction(function () use ($dynamicPage, $validatedData, $cover) {
            $dynamicPage->update(['slug' => $validatedData['slug']]);
            $oldContent = $dynamicPage
                ->contents()
                ->latest()
                ->first();
            $content = $dynamicPage->contents()->create([
                'subject' => $validatedData['subject'],
                'body' => $validatedData['body'],
            ]);
            if ($cover) {
                $path = $cover->store('covers', 'public');
                $content->cover = $path;
                $content->save();
            } elseif ($oldContent) {
                $content->cover = $oldContent->cover;
                $content->save();
            }
        });

        return redirect()->route('admin.dynamic-pages.show', $dynamicPage);
    }

    public function destroy(DynamicPage $dynamicPage)
    {
        DB::transaction(function () use ($dynamicPage) {
            $dynamicPage->contents()->delete();
            $dynamicPage->delete();
        });

        return redirect()->route('admin.dynamic-pages.index');
    }
}
