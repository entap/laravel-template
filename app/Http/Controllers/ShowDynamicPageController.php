<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use Illuminate\Http\Request;

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
        $contentBody = strip_tags(
            $content->body,
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
            'dynamic_pages.show',
            compact('page', 'content', 'contentBody')
        );
    }
}
