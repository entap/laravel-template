<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminProperty;
use App\Models\AdminPropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function create()
    {
        $typeOptions = AdminPropertyType::all(['id', 'display_name']);

        return view('admin.settings.properties.create', compact('typeOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'nullable',
            'type_id' => 'required|exists:admin_property_types,id',
        ]);

        AdminProperty::create($data);

        return redirect()->route('admin.settings.index');
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }
}
