<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
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
        ]);

        DB::transaction(function () use ($validatedData) {
            $dynamicPage = DynamicPage::create([
                'slug' => $validatedData['slug'],
            ]);
            $dynamicPage->contents()->create([
                'subject' => $validatedData['subject'],
                'body' => $validatedData['body'],
            ]);
        });

        return redirect()->route('admin.dynamic-pages.index');
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
        ]);

        DB::transaction(function () use ($dynamicPage, $validatedData) {
            $dynamicPage->update(['slug' => $validatedData['slug']]);
            $dynamicPage->contents()->create([
                'subject' => $validatedData['subject'],
                'body' => $validatedData['body'],
            ]);
        });

        return redirect()->route('admin.dynamic-pages.index');
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
