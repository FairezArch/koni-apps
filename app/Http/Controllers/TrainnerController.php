<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Nomor;
use App\Models\Sport;
use App\Models\Trainner;
use Illuminate\Http\Request;
use App\Models\TrainingPlace;
use App\Models\StatusTrainner;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\CertificateProfession;
use App\Http\Requests\StoreTrainnerRequest;
use App\Http\Requests\UpdateTrainnerRequest;
use App\Repository\Trainer\EloquentRepository;
use App\Repository\User\UserAs\EloquentRepositoryAs;

class TrainnerController extends Controller
{

    protected $trainer;
    protected $sport;
    protected $user;
    protected $userAs;
    protected $originModel;

    public function __construct(EloquentRepository $repository, EloquentRepositoryAs $repositoryAs, Trainner $trainer)
    {
        # code...
        $this->trainer = $repository;
        $this->sport = 'sports_id';
        $this->user = 'users_id';
        $this->userAs = $repositoryAs;
        $this->originModel = $trainer;
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
            $data = Trainner::where($this->sport, $sport_branch->id)->with(['sports', 'users', 'certificate_professions', 'status_trainners', 'nomor']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Trainner $row) {
                    $dateNow = Carbon::now();
                    $date_born = Carbon::parse($row->users->date_of_birth);
                    $age = $date_born->diffInYears($dateNow);
                    return $this->attrFormat($row->users->name, $age . ' Tahun');
                })
                ->addColumn('cabor', function (Trainner $row) {
                    return $this->attrFormat($row->sports->sportbranch_name, $row->nomor->nomor_code);
                })
                ->addColumn('trainer_status', function (Trainner $row) {
                    return $row->status ? 'Aktif' : 'Non Aktif';
                })
                ->addColumn('action', function (Trainner $row) {
                    return $row->id . ',' . $row->sports_id;
                })
                ->rawColumns(['name', 'cabor', 'trainer_status', 'action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.trainner.index-trainner', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        $clubs = Club::all();
        $nomors = Nomor::all();
        $status_trainners = StatusTrainner::all();
        $training_places = TrainingPlace::all();
        $certificates = CertificateProfession::all();

        return view('backend.pages.sportBranch.trainner.add-trainner', compact('sport_branch', 'clubs', 'nomors', 'status_trainners', 'certificates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrainnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainnerRequest $request, Sport $sport_branch)
    {
        //
        $request['roleID'] = $this->originModel->TempValue()['roleID'];
        $request['password'] = $this->originModel->TempValue()['password'];
        $userID = $this->userAs->storeData($request, []);
        $setExtraData = [$this->sport => $sport_branch->id, $this->user => $userID];
        $save = $this->trainer->storeData($request, $setExtraData);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Trainer created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Trainer created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainner  $trainner
     * @return \Illuminate\Http\Response
     */
    public function show(Trainner $trainner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainner  $trainner
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, Trainner $trainer)
    {
        //
        $lists = $trainer->with('users')->find($trainer->id);
        $sports = Sport::all();
        $clubs = Club::all();
        $nomors = Nomor::all();
        $status_trainners = StatusTrainner::all();
        $certificates = CertificateProfession::all();
        // $lists = Trainner::RelGetData($trainer->id);
        // $support_trainners = SupportTrainner::all();
        // $training_places = TrainingPlace::all();

        return view('backend.pages.sportBranch.trainner.edit-trainner', compact('sport_branch', 'trainer', 'lists', 'sports', 'clubs', 'nomors', 'status_trainners', 'certificates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrainnerRequest  $request
     * @param  \App\Models\Trainner  $trainner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainnerRequest $request, Sport $sport_branch, Trainner $trainer)
    {
        //
        $user = $this->userAs->updateData($request, [], User::findOrFail($request->users_id));
        $setExtraData = [$this->sport => $sport_branch->id];
        $up = $this->trainer->updateData($request, $setExtraData, $trainer);

        if ($up && $user) {
            $data = [
                'success' => true,
                'messages' => "Trainer updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Trainer updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainner  $trainner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport_branch, Trainner $trainer)
    {
        //
        $user = $this->userAs->deleteData(User::findOrFail($trainer->users_id));
        $delete = $this->trainer->deleteData($trainer);

        if ($delete && $user) {
            $data = [
                'success' => true,
                'messages' => "Trainner deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Trainner deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
