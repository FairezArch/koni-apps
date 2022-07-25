<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Nomor;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\SettingJudgeReferee;
use App\Http\Requests\StoreJudgeRequest;
use App\Http\Requests\UpdateJudgeRequest;
use App\Models\SettingJudgeRefereeLicence;
use App\Repository\judge\EloquentRepository;
use App\Repository\User\UserAs\EloquentRepositoryAs;

class JudgeController extends Controller
{
    protected $judge;
    protected $sport;
    protected $user;
    protected $userAs;
    protected $originModel;

    public function __construct(EloquentRepository $repository, EloquentRepositoryAs $repositoryAs, Judge $judge)
    {
        # code...
        $this->judge = $repository;
        $this->sport = 'sports_id';
        $this->user = 'users_id';
        $this->userAs = $repositoryAs;
        $this->originModel = $judge;
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
            $data = Judge::where($this->sport, $sport_branch->id)->with(['sports', 'users', 'setting_judge_referees', 'setting_judge_referee_licences']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Judge $row) {
                    $dateNow = Carbon::now();
                    $date_born = Carbon::parse($row->users->date_of_birth);
                    $age = $date_born->diffInYears($dateNow);
                    return $this->attrFormat($row->users->name, $age . ' Tahun');
                })
                ->addColumn('cabor', function (Judge $row) {
                    return $this->attrFormat($row->sports->sportbranch_name, $row->nomor->nomor_code);
                })
                ->addColumn('status', function (Judge $row) {
                    return $row->status ? 'aktif' : 'Non aktif';
                })
                ->addColumn('action', function (Judge $row) {
                    return $row->id . ',' . $row->sports_id;
                })
                ->rawColumns(['name', 'cabor', 'status', 'action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.judge.index-judge', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        $certificates = SettingJudgeReferee::all();
        $licences = SettingJudgeRefereeLicence::all();
        $nomors = Nomor::all();

        return view('backend.pages.sportBranch.judge.add-judge', compact('sport_branch', 'certificates', 'licences', 'nomors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJudgeRequest $request, Sport $sport_branch)
    {
        //
        $request['roleID'] = $this->originModel->TempValue()['roleID'];
        $request['password'] = $this->originModel->TempValue()['password'];
        $userID = $this->userAs->storeData($request, []);
        $setExtraData = [$this->sport => $sport_branch->id, $this->user => $userID];
        $save = $this->judge->storeData($request, $setExtraData);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Judge created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Judge created unsuccessfully"
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
    public function edit(Sport $sport_branch, Judge $judge)
    {
        //
        $lists = $judge->with('users')->find($judge->id);
        $sports = Sport::all();
        $nomors = Nomor::all();
        $certificates = SettingJudgeReferee::all();
        $licences = SettingJudgeRefereeLicence::all();

        return view('backend.pages.sportBranch.judge.edit-judge', compact('sport_branch', 'lists', 'certificates', 'licences', 'nomors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJudgeRequest $request, Sport $sport_branch, Judge $judge)
    {
        //
        $user = $this->userAs->updateData($request, [], User::findOrFail($request->users_id));
        $setExtraData = [$this->sport => $sport_branch->id];
        $up = $this->judge->updateData($request, $setExtraData, $judge);

        if ($up && $user) {
            $data = [
                'success' => true,
                'messages' => "Judge updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Judge updated unsuccessfully"
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
    public function destroy(Sport $sport_branch, Judge $judge)
    {
        //
        $user = $this->userAs->deleteData(User::findOrFail($judge->users_id));
        $del = $this->judge->deleteData($judge);

        if ($del && $user) {
            $data = [
                'success' => true,
                'messages' => "Judge deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Judge deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
