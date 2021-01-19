<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminProperty;
use App\Models\AdminPropertyType;
use App\Http\Controllers\Controller;
use App\Models\AdminPropertyGroup;

class PropertyGroupPropertyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AdminPropertyGroup $group)
    {
        $typeOptions = AdminPropertyType::all(['id', 'name', 'display_name']);

        return view(
            'admin.settings.groups.properties.create',
            compact('group', 'typeOptions')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AdminPropertyGroup $group)
    {
        $data = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'nullable',
            'type_id' => 'required|exists:admin_property_types,id',
        ]);

        $group->properties()->create($data);

        return redirect()->route('admin.settings.groups.show', $group);
    }
}
