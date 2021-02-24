<?php

namespace App\Http\Controllers;

use App\Http\Resources\DynamicContent as DynamicContentResource;
use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class ShowDynamicPageController extends Controller
{
    /**
     * 動的コンテンツを表示する
     */
    public function __invoke(Request $request, DynamicPage $page)
    {
        $content = $page
            ->contents()
            ->latest()
            ->first();

        if ($request->expectsJson()) {
            return new DynamicContentResource($content);
        }
        return view('dynamic_pages.show', compact('page', 'content'));
    }
}
