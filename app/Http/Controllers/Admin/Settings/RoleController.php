<?php
namespace App\Http\Controllers\Admin\Settings;

use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\Permission;
use App\Events\Admin\RoleCreated;
use App\Events\Admin\RoleDeleted;
use App\Events\Admin\RoleUpdated;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validateRole($request);

        $role = DB::transaction(function () use ($request) {
            $role = Role::create($request->only('name'));
            $role->permissions()->sync($request->input('permissions'));
            return $role;
        });

        event(new RoleCreated($request->user(), $role));

        return redirect()->route('admin.settings.roles.index');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validateRole($request, $role);

        DB::transaction(function () use ($request, $role) {
            $role->update($request->only('name'));
            $role->permissions()->sync($request->input('permissions'));
        });

        event(new RoleUpdated($request->user(), $role));

        return redirect()->route('admin.settings.roles.show', $role);
    }

    public function destroy(Role $role)
    {
        // TODO Policy にまとめる
        if ($role->users()->count() > 0) {
            return back()->with(
                'error',
                'ユーザーを持つロールは削除できません'
            );
        }

        $role->delete();

        event(new RoleDeleted(request()->user(), $role));

        return redirect()->route('admin.settings.roles.index');
    }

    protected function validateRole(Request $request, Role $role = null)
    {
        // TODO FormRequest にまとめる
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admin_roles')->ignore($role),
            ],
            'permissions' => 'array',
            'permissions.*' => 'required|exists:admin_permissions,id',
        ]);
    }
}
