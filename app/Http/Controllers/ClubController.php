<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Sport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;

class ClubController extends Controller
{

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
            $data = Club::where('sports_id', $sport_branch->id)->orderBy('id', 'DESC')->with('users', 'atlets', 'trainers');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('club', function (Club $row) {
                    $url = asset("storage/club/" . $row->file_club);
                    $temp = '<div class="d-flex">
                                <div class="images_wrapp mr-2">
                                    <img src="' . $url . '" border="0" width="40" class="img-rounded img-thumbnail" align="center" />
                                </div>
                                <div>
                                    ' . $this->attrFormat('<a href="'.route('sport-branch.clubs.show',[$row->sports_id, $row->id]).'">'.$row->club_name.'</a>', $row->users->name) . '
                                </div>
                            </div>';
                    return $temp;
                })
                ->addColumn('nomor', function (Club $row) {
                    return $row->atlets->groupBy('nomors_id')->count() + $row->trainers->groupBy('nomors_id')->count() . ' Nomor';
                })
                ->addColumn('atlet', function (Club $row) {
                    return $row->atlets->count() . ' Atlet';
                })
                ->addColumn('trainner', function (Club $row) {
                    return $row->trainers->count() . ' Pelatih';
                })
                ->addColumn('status', function (Club $row) {
                    return $row->status ? "Aktif" : "Tidak Aktif";
                })
                ->addColumn('action', function (Club $row) {
                    return $row->id . ',' . $row->sports_id;
                })
                ->rawColumns(['club', 'nomor', 'atlet', 'trainner', 'status', 'action'])
                ->make(true);
        }
        return view('backend.pages.sportBranch.clubs.index-club', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        $optionRole = 5;
        $users = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();
        return view('backend.pages.sportBranch.clubs.add-club', compact('sport_branch', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClubRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClubRequest $request, Sport $sport_branch)
    {
        //
        $save = Club::StoreData($request, $sport_branch);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Club created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Club created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport_branch, Club $club)
    {
        //
        $list = $club->with(['atlets', 'trainers', 'judges'])->find($club->id);
        return view('backend.pages.sportBranch.clubs.detail-club', compact('sport_branch', 'list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, Club $club)
    {
        //
        $optionRole = 5;
        $lists = $club;
        $users = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();

        return view('backend.pages.sportBranch.clubs.edit-club', compact('sport_branch', 'lists', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClubRequest  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClubRequest $request, sport $sport_branch, Club $club)
    {
        //
        // dd($request->all());
        $update = Club::UpdateData($request, $sport_branch, $club);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "Club updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Club updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport_branch, Club $club)
    {
        
        $delete = Club::DeleteData($sport_branch, $club);

        if ($delete) {
            $data = [
                'success' => true,
                'messages' => "Club deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Club deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Duplicate edit to update for profile club
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */

    public function editProfile(Club $club)
    {
        //
        $optionRole = 5;
        $lists = $club;
        $users = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();

        return view('backend.pages.club.profile.edit-club', compact('club', 'lists', 'users'));
    }

    public function showProfile(Club $club)
    {
        //
        $list = $club->with(['atlets', 'trainers', 'judges'])->find($club->id);
        return view('backend.pages.club.profile.detail-club', compact('club', 'list'));
    }

    public function updateProfile(UpdateClubRequest $request, Club $club)
    {
        //
        $update = Club::UpdateDataProfileClub($request, $club);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "Club updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Club updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
