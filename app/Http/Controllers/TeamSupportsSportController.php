<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sport;
use App\Models\Employ;
use App\Models\ChildRole;
use App\Models\TeamSupport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTeamSupportRequest;
use App\Http\Requests\UpdateTeamSupportRequest;
use App\Repository\TeamSupport\EloquentTeamSupportRepository;

class TeamSupportsSportController extends Controller
{

    protected $teamSupport;
    protected $fieldData;

    public function __construct(EloquentTeamSupportRepository $repository)
    {
        $this->teamSupport = $repository;
        $this->fieldData = 'sports_id';
    }

    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
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
            $data = $this->teamSupport->indexData($this->fieldData, $sport_branch->id)->with(['users','sports'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $url = asset("storage/users/" . $row->users->photo);
                    $temp = '<div class="d-flex">
                                <div class="images_wrapp mr-2">
                                    <img src=\'' . $url . '\' alt="image" border="0" width="40" class="img-rounded img-thumbnail" align="center" />
                                </div>
                                <div>' . $row->users->name . '</div>
                            </div>';
                    return $temp;
                })
                ->addColumn('task', function ($row) {
                    return $this->attrFormat($row->users->sk_number, Carbon::parse($row->users->sk_date_to)->translatedFormat('d F Y'));
                })
                ->addColumn('contact_person', function ($row) {
                    return $this->attrFormat($row->users->email, $row->users->phone_number);
                })
                ->addColumn('action', function ($row) {
                    return json_encode(array($row->sports->id, $row->id));
                })
                ->rawColumns(['name', 'task', 'contact_person', 'action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.subViews.teamSupport.index-teamsupport', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        # Testing
        // $ids = [4,11,12];
        // $role = Role::whereIn('id', $ids)->get();

        # Real implementation
        $role = ChildRole::where('parent_role', Auth::user()->roles->first()->id)->with('roles')->get();
        // dd($role);
        $employs = Employ::all();

        return view('backend.pages.sportBranch.subViews.teamSupport.add-teamsupport', compact('role', 'employs', 'sport_branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamSupportRequest $request, Sport $sport_branch)
    {
        //
        $dataInput = [$this->fieldData => $sport_branch->id];
        $save = $this->teamSupport->storeData($request, $dataInput);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Team Support created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Team Support created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamSupport  $teamSport
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport_branch, TeamSupport $team_support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamSupport  $teamSport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, TeamSupport $team_support)
    {
        //
        // $idsRole = [4,11,12];
        // $role = Role::whereIn('id', $idsRole)->get();

        # Real implementation
        $role = ChildRole::where('parent_role', Auth::user()->roles->first()->id)->with('roles')->get();
        $employs = Employ::all();
        $team_support = $team_support->with('users')->first();
        $roleuser = DB::table('model_has_roles')->where('model_id', $team_support->users->id)->first();
        
        return view('backend.pages.sportBranch.subViews.teamSupport.edit-teamsupport', compact('role', 'employs', 'sport_branch', 'team_support', 'roleuser'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamSupport  $teamSport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamSupportRequest $request, Sport $sport_branch, TeamSupport $team_support)
    {
        //
        $dataInput = [$this->fieldData => $sport_branch->id];
        $update = $this->teamSupport->updateData($request, $team_support, $dataInput);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "Team Support Updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Team Support Updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamSupport  $teamSport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport_branch, TeamSupport $team_support)
    {
        //
        $delete = $this->teamSupport->deleteData($team_support);

        if ($delete) {
            $data = [
                'success' => true,
                'messages' => "Team Support Deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Team Support Deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
