<?php

namespace App\Repository\Role;

use App\Models\ChildRole;
use App\Repository\Role\RoleRepository;
use Spatie\Permission\Models\Role;

class EloquentRoleRepository implements RoleRepository
{
    protected $model;
    private $field;

    public function __construct(ChildRole $child_role)
    {
        # code...
        $this->model = $child_role;
        $this->field = 'roles_id';
    }

    public function indexData($param, $set)
    {
        # code...
        return $this->model->where($param, $set);
    }

    public function storeData($request, $getInput)
    {
        # code...
        $save = Role::create(['name' => strtolower($request->name)]);
        $last_id = $save->id;

        $setData = [$this->field => $last_id];
        $mergeData = array_merge($setData, $getInput);

        $decode_permission = json_decode($request->input('permission'), true);
        $save->syncPermissions($decode_permission);
        
        return $this->model->create($mergeData);
    }

    public function updateData($request, $modelData, $getInput)
    {
        # code...
        $save = Role::find($modelData->roles_id);
        $save->update(['name' => strtolower($request->input('name'))]);

        $setData = [$this->field => $modelData->roles_id];
        $mergeData = array_merge($setData, $getInput);

        $decode_permission = json_decode($request->input('permission'), true);
        $save->syncPermissions($decode_permission);
        
        return $modelData->update($mergeData);
    }
}