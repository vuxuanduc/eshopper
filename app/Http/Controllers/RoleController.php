<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function index()
    {
        $permissionRole = PermissionRole::getPermission('Role', Auth::user()->role_id);
        $permissionAddRole = PermissionRole::getPermission('Add Role', Auth::user()->role_id);
        $permissionEditRole = PermissionRole::getPermission('Edit Role', Auth::user()->role_id);
        $permissionDeleteRole = PermissionRole::getPermission('Delete Role', Auth::user()->role_id);
        if (empty($permissionRole)) {
            abort(404);
        }
        $title = "Roles";
        $roles = Role::all();
        return view('admins.roles.index', compact('title', 'roles', 'permissionAddRole', 'permissionEditRole', 'permissionDeleteRole'));
    }


    public function create()
    {
        $permissionAddRole = PermissionRole::getPermission('Add Role', Auth::user()->role_id);
        if (empty($permissionAddRole)) {
            abort(404);
        }
        $getPermissions = Permission::getPermissions();
        $title = "Create role";
        return view('admins.roles.create', compact('title', 'getPermissions'));
    }


    public function store(Request $request)
    {
        $permissionAddRole = PermissionRole::getPermission('Add Role', Auth::user()->role_id);
        if (empty($permissionAddRole)) {
            abort(404);
        }
        $role =  Role::query()->create($request->except('permission_id'));
        PermissionRole::insertPermissionRole($request->permission_id, $role->id);
        return redirect()->route('roles.index')->with('success', "Role successfully create!");
    }


    public function edit(string $id)
    {
        $permissionEditRole = PermissionRole::getPermission('Edit Role', Auth::user()->role_id);
        if (empty($permissionEditRole)) {
            abort(404);
        }
        $title = "Update role";
        $role = Role::find($id);
        $getPermissions = Permission::getPermissions();
        $getPermissionRoles = PermissionRole::where('role_id', '=', $id)->get();
        // dd($getPermissionRoles);
        return view('admins.roles.edit', compact('title', 'role', 'getPermissions', 'getPermissionRoles'));
    }


    public function update(Request $request, string $id)
    {
        $permissionEditRole = PermissionRole::getPermission('Edit Role', Auth::user()->role_id);
        if (empty($permissionEditRole)) {
            abort(404);
        }
        $role = Role::find($id);
        $role->update($request->except('permission_id'));
        PermissionRole::updatePermissionRole($request->permission_id, $role->id);
        return redirect()->route('roles.index')->with('success', "Role successfully update!");
    }


    public function destroy(string $id)
    {
        $permissionDeleteRole = PermissionRole::getPermission('Delete Role', Auth::user()->role_id);
        if (empty($permissionDeleteRole)) {
            abort(404);
        }
        $role = Role::find($id);
        $role->delete();
        return back()->with('success', "Delete role successfully");
    }
}
