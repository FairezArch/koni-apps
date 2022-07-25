<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function roles()
    {
        # code...
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function parentRole()
    {
        # code...
        return $this->belongsTo(Role::class, 'parent_role')->withDefault();
    }

    public function scopeFindPermission(Builder $query, $data)
    {
        # code...
        return DB::table("role_has_permissions")->where("role_has_permissions.role_id", $data)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();
    }
}
