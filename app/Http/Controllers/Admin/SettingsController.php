<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminProperty;
use App\Http\Controllers\Controller;
use App\Query\Services\Admin\PropertyGroupQueryService;

class SettingsController extends Controller
{
    protected $groups;

    public function __construct(PropertyGroupQueryService $groups)
    {
        $this->groups = $groups;
    }

    public function index(Request $request)
    {
        $groups = $this->groups->all();
        $independentProperties = AdminProperty::independent()->get();

        return view(
            'admin.settings.index',
            compact('groups', 'independentProperties')
        );
    }
}
