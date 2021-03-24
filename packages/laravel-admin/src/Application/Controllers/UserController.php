<?php
namespace Entap\Admin\Application\Controllers;

use Entap\Admin\Database\Models\Permission;
use Entap\Admin\Database\Models\Role;
use Illuminate\Http\Request;
use Entap\Admin\Facades\Admin;
use Entap\Admin\Database\Models\User;
use Entap\Admin\Database\Models\UserGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $users = User::latest()->get();

        return view('admin::users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $groupOptions = UserGroup::all();

        return view(
            'admin::users.create',
            compact('roles', 'permissions', 'groupOptions')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:20',
                Rule::unique('admin_users'),
            ],
            'password' => 'required|string|between:8,255|confirmed',
            'roles' => 'array',
            'roles.*' => 'required|exists:admin_roles,id',
            'permissions' => 'array',
            'permissions.*' => 'required|exists:admin_permissions,id',
            'group_id' => 'nullable|integer|exists:admin_user_groups,id',
        ]);

        return DB::transaction(function () use ($request) {
            $user = User::create(
                array_merge($request->only(['name', 'username']), [
                    'password' => Hash::make($request->input('password')),
                ])
            );

            $user->roles()->sync($request->input('roles'));

            $user->permissions()->sync($request->input('permissions'));

            $user->groups()->sync($request->input('group_id'));

            return redirect()->route('admin.settings.users.index');
        });
    }

    public function show(User $user)
    {
        return view('admin::users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $groupOptions = UserGroup::all();

        return view(
            'admin::users.edit',
            compact('user', 'roles', 'permissions', 'groupOptions')
        );
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:20',
                Rule::unique('admin_users')->ignore($user),
            ],
            'password' => 'nullable|string|between:8,255|confirmed',
            'roles' => 'array',
            'roles.*' => 'required|exists:admin_roles,id',
            'permissions' => 'array',
            'permissions.*' => 'required|exists:admin_permissions,id',
            'group_id' => 'nullable|integer|exists:admin_user_groups,id',
        ]);

        return DB::transaction(function () use ($request, $user) {
            $user->update($request->only(['name', 'username']));
            $this->updatePassword($request, $user);
            $this->updateRoles($request, $user);
            $this->updatePermissions($request, $user);
            $user->groups()->sync($request->input('group_id'));

            return redirect()->route('admin.settings.users.show', $user);
        });
    }

    public function destroy(User $user)
    {
        if (Admin::user()->id === $user->id) {
            abort(403, '自分自身は削除できません。');
        }

        $user->delete();

        return redirect()->route('admin.settings.users.index');
    }

    protected function updatePassword(Request $request, User $user)
    {
        if (!$request->filled('password')) {
            return;
        }
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);
    }

    protected function updateRoles(Request $request, User $user)
    {
        $user->roles()->sync($request->input('roles'));
    }

    protected function updatePermissions(Request $request, User $user)
    {
        $user->permissions()->sync($request->input('permissions'));
    }
}
