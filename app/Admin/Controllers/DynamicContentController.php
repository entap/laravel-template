<?php

namespace App\Admin\Controllers;

use App\Models\DynamicPage;
use Illuminate\Http\Request;
use App\Models\DynamicContent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Admin\Controllers\Controller;

class DynamicContentController extends Controller
{
    public function show(DynamicContent $dynamicContent)
    {
        return view('dynamic_pages.show', ['content' => $dynamicContent]);
    }
}
