<?php

namespace App\Http\Controllers;

use DB;
use App\Models\SidebarMenu;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRolePermissionRequest;
use App\Http\Requests\UpdateRolePermissionRequest;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = RolePermission::CountPermissionUsers();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return ucfirst($row->name);
                })
                ->addColumn('members', function ($row) {
                    return $row->count_user." Member(s)";
                })
                ->addColumn('permission', function ($row) {
                    return 'Permission';
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name', 'members', 'permission', 'action'])
                ->make(true);
        }

        return view('backend.pages.rolePermissions.index-rolePermission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parent_menu = SidebarMenu::all();
        $permissions = Permission::all();
         
        return view('backend.pages.rolePermissions.add-rolePermission',compact('parent_menu','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRolePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolePermissionRequest $request)
    {
        //

        $role = Role::create(['name' => strtolower($request->name)]);
        $de = json_decode($request->input('permission'), true);
        
        $role->syncPermissions($de);
    
        if($role){
            $data = [
                'success' => true,
                'messages' => "Role Permission created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Role Permission created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::find($id);
        $parent_menu = SidebarMenu::all();
        $permissions = Permission::all();
        $rolePermissions = RolePermission::rolePermissionM($id);
        
        return view('backend.pages.rolePermissions.edit-rolePermission',compact('role','parent_menu','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRolePermissionRequest  $request
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolePermissionRequest $request, RolePermission $rolePermission, $id)
    {
        //
        $role = Role::find($id);
        $role->name = strtolower($request->input('name'));
        $role->save();
        $de = json_decode($request->input('permission'), true);
        
        $role->syncPermissions($de);
     
        if($role){
            $data = [
                'success' => true,
                'messages' => "Role Permission updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Role Permission updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolePermission $rolePermission, $id)
    {
        //
        $role = Role::find($id);
        $role->delete();

        if($role){
            $data = [
                'success' => true,
                'messages' => "Role Permission deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Role Permission deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}
