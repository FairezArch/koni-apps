<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\ChildRole;
use App\Models\SidebarMenu;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Repository\Role\EloquentRoleRepository;
use App\Http\Requests\StoreRolePermissionRequest;
use App\Http\Requests\UpdateRolePermissionRequest;

class RoleSportController extends Controller
{
    protected $sidebar_ids;
    protected $repository;

    public function __construct(EloquentRoleRepository $repository_role)
    {
        # code...
        $this->sidebar_ids = [2, 3, 4, 5, 7, 10, 20];
        $this->repository = $repository_role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Sport $sport_branch)
    {
        //
        if ($request->ajax()) {
            $data = $this->repository->indexData('parent_role', Auth::user()->roles->first()->id)->with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return ucfirst($row->roles->name);
                })
                ->addColumn('action', function ($row) use ($sport_branch) {
                    return json_encode([$sport_branch->id, $row->id]);
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.subViews.role.index-role', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        $parent_menu = SidebarMenu::whereIn('id', $this->sidebar_ids)->get();
        $permissions = Permission::all();

        return view('backend.pages.sportBranch.subViews.role.add-role', compact('sport_branch', 'parent_menu', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolePermissionRequest $request, Sport $sport_branch)
    {
        //
        $setData = ['parent_role' => Auth::user()->roles->first()->id];
        $save = $this->repository->storeData($request, $setData);

        if($save){
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport_branch, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, $id)
    {
        //
        $role_permission = ChildRole::with('roles')->find($id);
        $parent_menu = SidebarMenu::whereIn('id', $this->sidebar_ids)->get();
        $permissions = Permission::all();
        $findPermission = ChildRole::findPermission($role_permission->roles_id);

        return view('backend.pages.sportBranch.subViews.role.edit-role', compact('sport_branch', 'parent_menu', 'permissions', 'role_permission', 'findPermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolePermissionRequest $request, Sport $sport_branch, $id)
    {
        //
        $setData = ['parent_role' => Auth::user()->roles->first()->id];
        $modelData = ChildRole::find($id);
        $update = $this->repository->updateData($request, $modelData, $setData);

        if($update){
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport_branch, ChildRole $role_permission)
    {
        //
    }
}
