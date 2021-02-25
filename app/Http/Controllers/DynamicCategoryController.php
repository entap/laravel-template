<?php

namespace App\Http\Controllers;

use App\Models\DynamicCategory;
use Illuminate\Http\Request;

class DynamicCategoryController extends Controller
{
    public function index()
    {
        $categories = DynamicCategory::withDepth()->get();

        return ['data' => $categories->toTree()];
    }
}
