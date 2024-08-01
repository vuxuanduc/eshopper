<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    static public function insertPermissionRole($permission_ids, $role_id)
    {
        foreach ($permission_ids as $permission_id) {
            $data['role_id'] = $role_id;
            $data['permission_id'] = $permission_id;

            PermissionRole::query()->create($data);
        }
    }

    static public function updatePermissionRole($permission_ids, $role_id)
    {
        PermissionRole::where('role_id', '=', $role_id)->delete();

        if (!empty($permission_ids)) {
            foreach ($permission_ids as $permission_id) {
                $data['role_id'] = $role_id;
                $data['permission_id'] = $permission_id;

                PermissionRole::query()->create($data);
            }
        }
    }

    static public function getPermission($slug, $role_id)
    {
        return PermissionRole::select('permission_roles.id')
            ->join('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
            ->where('permission_roles.role_id', '=', $role_id)
            ->where('permissions.slug', '=', $slug)
            ->count();
    }
}
