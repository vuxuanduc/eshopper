<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'group_by'
    ];

    static public function getPermissions()
    {
        $getPermissions = Permission::groupBy('group_by')->get();
        $result = array();
        foreach ($getPermissions as $value) {
            $getPermissionsGroup = Permission::getPermissionsGroup($value->group_by);

            $data = array();
            $data['id'] = $value->id;
            $data['name'] = $value->name;
            $group = array();
            foreach ($getPermissionsGroup as $valueG) {
                $dataG = array();
                $dataG['id'] = $valueG->id;
                $dataG['name'] = $valueG->name;

                $group[] = $dataG;
            }
            $data['group'] = $group;
            $result[] = $data;
        }

        return $result;
    }

    static public function getPermissionsGroup($groupBy)
    {
        return Permission::where('group_by', '=', $groupBy)->get();
    }
}
