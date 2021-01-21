<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        $groups = AdminUserGroup::all();

        return view('admin.user-groups.index', compact('groups'));
    }

    public function create()
    {
        $parentOptions = AdminUserGroup::all();

        return view('admin.user-groups.create', compact('parentOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'parent_id' => 'nullable|exists:admin_user_groups,id',
        ]);

        AdminUserGroup::create($data);

        return redirect()->route('admin.user-groups.index');
    }

    public function edit(AdminUserGroup $userGroup)
    {
        $parentOptions = AdminUserGroup::all()->except($userGroup->id);

        return view('admin.user-groups.edit', [
            'group' => $userGroup,
            'parentOptions' => $parentOptions,
        ]);
    }

    public function update(Request $request, AdminUserGroup $userGroup)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'parent_id' => 'nullable|exists:admin_user_groups,id',
        ]);

        $userGroup->update($data);

        return redirect()->route('admin.user-groups.index');
    }

    public function destroy(AdminUserGroup $userGroup)
    {
        $userGroup->delete();

        return redirect()->route('admin.user-groups.index');
    }
}
