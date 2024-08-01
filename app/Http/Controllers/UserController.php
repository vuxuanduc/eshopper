<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $permissionUser = PermissionRole::getPermission('User', Auth::user()->role_id);
        $permissionAddUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        $permissionEditUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        $permissionDeleteUser = PermissionRole::getPermission('Delete User', Auth::user()->role_id);
        if (empty($permissionUser)) {
            abort(404);
        }
        $title = "Users";
        $users = User::select('id', 'name', 'email', 'role_id', 'is_active')->with('role')->get();
        return view('admins.users.index', compact('title', 'users', 'permissionAddUser', 'permissionEditUser', 'permissionDeleteUser'));
    }

    public function create()
    {
        $permissionAddUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if (empty($permissionAddUser)) {
            abort(404);
        }
        $title = "Create user";
        $roles = Role::select('id', 'name_role')->get();
        return view('admins.users.create', compact('title', 'roles'));
    }


    public function store(Request $request)
    {
        $permissionAddUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if (empty($permissionAddUser)) {
            abort(404);
        }
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('users.index')->with('success', "Create user successfully!");
    }


    public function edit(string $id)
    {
        $permissionEditUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if (empty($permissionEditUser)) {
            abort(404);
        }
        $title = "Update user";
        $user = User::find($id);
        $roles = Role::select('id', 'name_role')->get();
        return view('admins.users.edit', compact('title', 'roles', 'user'));
    }


    public function update(Request $request, string $id)
    {
        $permissionEditUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if (empty($permissionEditUser)) {
            abort(404);
        }
        $user = User::find($id);
        $data = $request->all();
        $user->update($data);
        return redirect()->route('users.index')->with('success', "Update user successfully!");
    }

    public function destroy(string $id)
    {
        $permissionDeleteUser = PermissionRole::getPermission('Delete User', Auth::user()->role_id);
        if (empty($permissionDeleteUser)) {
            abort(404);
        }
        $user = User::find($id);

        $user->delete();

        return back()->with('success', "Delete user successfully!");
    }
}
