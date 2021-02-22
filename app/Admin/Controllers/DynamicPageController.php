<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Support\Facades\DB;

class DynamicPageController extends Controller
{
    public function index()
    {
        $pages = DynamicPage::with('contents')->get();

        return view('admin.dynamic_pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.dynamic_pages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slug' => 'required|string|alpha_dash|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $dynamicPage = DynamicPage::where(
            'slug',
            $validatedData['slug']
        )->firstOrCreate([
            'slug' => $validatedData['slug'],
        ]);
        $dynamicPage->contents()->create([
            'subject' => $validatedData['subject'],
            'body' => $validatedData['body'],
        ]);

        return redirect()->route('admin.dynamic-pages.index');
    }

    public function edit(DynamicPage $dynamicPage)
    {
        $content = $dynamicPage
            ->contents()
            ->latest()
            ->firstOrNew();
        $contentBody = strip_tags(
            $content->body ?? '',
            implode(
                '',
                array_map(
                    function ($tag) {
                        return "<{$tag}>";
                    },
                    ['a', 'strong']
                )
            )
        );

        return view(
            'admin.dynamic_pages.edit',
            compact('dynamicPage', 'content', 'contentBody')
        );
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
