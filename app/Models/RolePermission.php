<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolePermission extends Model
{
    use HasFactory;

    public function scopeCountPermissionUsers(Builder $query)
    {
        # code...
        return DB::table('roles')
            ->leftjoin('model_has_roles', 'roles.id', 'model_has_roles.role_id')
            ->leftjoin('users', 'model_has_roles.model_id', 'users.id')
            ->select('roles.id', 'roles.name', DB::raw("count(users.id) as count_user"))
            ->where([['roles.id', '!=', 1],['roles.id', '!=', 3]])
            ->groupBy('roles.id')
            ->get();
    }

    public function scopeRolePermissionM(Builder $query, $id)
    {
        # code...
        return DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    }
}
