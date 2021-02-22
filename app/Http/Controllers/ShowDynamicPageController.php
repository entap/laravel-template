<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class ShowDynamicPageController extends Controller
{
    /**
     * 動的コンテンツを表示する
     */
    public function __invoke(DynamicPage $page)
    {
        $content = $page
            ->contents()
            ->latest()
            ->first();

        return view('dynamic_pages.show', compact('page', 'content'));
    }
}
