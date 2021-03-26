<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DynamicContent;
use App\Http\Controllers\Admin\Controller;

class DynamicContentController extends Controller
{
    /**
     * プレビュー
     */
    public function show(DynamicContent $dynamicContent)
    {
        return view('dynamic_pages.show', ['content' => $dynamicContent]);
    }
}
