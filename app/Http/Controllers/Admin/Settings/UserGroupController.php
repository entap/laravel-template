<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Models\Admin\UserGroup;
use App\Http\Controllers\Admin\Controller;
use App\Query\Services\UserGroupQueryService;

class UserGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index(UserGroupQueryService $queryService, Request $request)
    {
        $options = $request->validate([
            'name' => 'nullable|string',
        ]);

        $groups = $queryService
            ->query($options)
            ->withDepth()
            ->get()
            ->toFlatTree();

        return view('admin.user_groups.index', compact('groups'));
    }

    public function create()
    {
        $parentOptions = UserGroup::all();

        return view('admin.user_groups.create', compact('parentOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'parent_id' => 'nullable|exists:admin_user_groups,id',
        ]);

        UserGroup::create($data);

        return redirect()->route('admin.settings.user-groups.index');
    }

    public function edit(UserGroup $userGroup)
    {
        $parentOptions = UserGroup::all()->except($userGroup->id);

        return view('admin.user_groups.edit', [
            'group' => $userGroup,
            'parentOptions' => $parentOptions,
        ]);
    }

    public function update(Request $request, UserGroup $userGroup)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'parent_id' => 'nullable|exists:admin_user_groups,id',
        ]);

        $userGroup->update($data);

        return redirect()->route('admin.settings.user-groups.index');
    }

    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();

        return redirect()->route('admin.settings.user-groups.index');
    }
}
