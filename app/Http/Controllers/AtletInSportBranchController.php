<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Atlet;
use App\Models\Nomor;
use App\Models\Sport;
use App\Models\MediaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Repository\Atlet\EloquentRepository;
use App\Repository\User\UserAs\EloquentRepositoryAs;

class AtletInSportBranchController extends Controller
{
    protected $atlet;
    protected $sport;
    protected $club;
    protected $user;
    protected $userAs;
    protected $atletModel;

    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
    }

    public function __construct(EloquentRepository $repository, EloquentRepositoryAs $repositoryAs, Atlet $atlet)
    {
        #code...
        $this->atlet = $repository;
        $this->sport = 'sports_id';
        $this->club = 'clubs_id';
        $this->user = 'users_id';
        $this->userAs = $repositoryAs;
        $this->originModel = $atlet;
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
            $data = Atlet::where($this->sport, $sport_branch->id)->with(['users', 'sports']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Atlet $row) {
                    $dateNow = Carbon::now();
                    $date_born = Carbon::parse($row->users->date_of_birth);
                    $age = $date_born->diffInYears($dateNow);
                    return $this->attrFormat($row->users->name, $age . ' Tahun');
                })
                ->addColumn('cabor', function (Atlet $row) {
                    return $this->attrFormat($row->sports->sportbranch_name, $row->nomor_id);
                })
                ->addColumn('status', function (Atlet $row) {
                    return $row->status_atlet ? 'Aktif' : 'Non Aktif';
                })
                ->addColumn('action', function (Atlet $row) {
                    return $row->id . ',' . $row->sports_id;
                })
                ->rawColumns(['name', 'cabor', 'status', 'action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.atlet.index-atlet', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        $clubs = Club::where($this->sport, $sport_branch->id)->get();
        $nomors = Nomor::where($this->sport, $sport_branch->id)->get();
        return view('backend.pages.sportBranch.atlet.add-atlet', compact('clubs', 'nomors', 'sport_branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtletRequest $request, Sport $sport_branch)
    {
        //
        $request['roleID'] = $this->originModel->TempValue()['roleID'];
        $request['password'] = $this->originModel->TempValue()['password'];
        $userID = $this->userAs->storeData($request, []);
        $setExtraData = [$this->sport => $sport_branch->id, $this->club => $request->clubs_id, $this->user => $userID];
        $save = $this->atlet->storeData($request, $setExtraData);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Atlet created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Atlet created unsuccessfully"
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, Atlet $atlet)
    {
        //
        $lists = $atlet->with('users')->find($atlet->id);
        $clubs = Club::all();
        $nomors = Nomor::where($this->sport, $sport_branch->id)->get();

        return view('backend.pages.sportBranch.atlet.edit-atlet', compact('sport_branch', 'clubs', 'nomors', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtletRequest $request, Sport $sport_branch, Atlet $atlet)
    {
        //
        $user = $this->userAs->updateData($request, [], User::findOrFail($request->users_id));
        $setExtraData = [$this->sport => $sport_branch->id, $this->club => $request->clubs_id];
        $update = $this->atlet->updateData($request, $setExtraData, $atlet);

        if ($update && $user) {
            $data = [
                'success' => true,
                'messages' => "Atlet updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Atlet updated unsuccessfully"
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
    public function destroy(Sport $sport_branch, Atlet $atlet)
    {
        //
        $user = $this->userAs->deleteData(User::findOrFail($atlet->users_id));
        $delete = $this->atlet->deleteData($atlet);

        if ($delete && $user) {
            $data = [
                'success' => true,
                'messages' => "Atlet deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Atlet deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    public function atlet_achievement(Request $request, MediaModel $mediaModel, $id, $atlet_id)
    {
        # code...
        $achievement = $this->atlet->achievement($request, $id, $atlet_id);

        // $folder = 'atlet_achievement';
        // $section = 'insert';

        // $achievement = Achievement::create([
        //     'nomor_code' => $request->nomor_code,
        //     'date_from' => $request->date_from,
        //     'date_to' => $request->date_to,
        //     'sports_id' => $id,
        //     'nomors_id' => $request->nomors_id,
        //     'atlets_id' => $atlet_id,
        //     'achievement_level' => $request->achievement_level,
        //     'medal' => $request->medal,
        //     'file_achievement' => $mediaModel->AddMedia($request->file_achievement, $folder, $section),
        //     'status_achievement' => $request->status_achievement
        // ]); #old

        if ($achievement) {
            $data = [
                'success' => true,
                'messages' => "Achievement created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Achievement created unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
