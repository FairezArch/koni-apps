<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Atlet;
use App\Models\Nomor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Repository\Atlet\EloquentRepository;
use App\Repository\User\UserAs\EloquentRepositoryAs;

class AtletInClubOwnController extends Controller
{
    protected $atlet;
    protected $sport;
    protected $club;
    protected $userAs;
    protected $atletModel;

    public function __construct(EloquentRepository$repository, EloquentRepositoryAs $repositoryAs, Atlet $atlet)
    {
        # code...
        $this->atlet = $repository;
        $this->sport = 'sports_id';
        $this->club = 'clubs_id';
        $this->userAs = $repositoryAs;
        $this->originModel = $atlet;
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
    public function index(Request $request, Club $club)
    {
        //
        if ($request->ajax()) {
            $data = Atlet::where($this->sport, $club->sports_id)->where($this->club, $club->id)->with(['users', 'sports']);
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
                    return $row->id . ',' . $row->clubs_id;
                })
                ->rawColumns(['name', 'cabor', 'status', 'action'])
                ->make(true);
        }

        return view('backend.pages.club.atlet.index-atlet', compact('club'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Club $club)
    {
        //
        $nomors = Nomor::where($this->sport, $club->sports_id)->get();
        return view('backend.pages.club.atlet.add-atlet', compact('club', 'nomors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtletRequest $request, Club $club)
    {
        //
        $request['roleID'] = $this->originModel->TempValue()['roleID'];
        $request['password'] = $this->originModel->TempValue()['password'];
        $userID = $this->userAs->storeData($request, []);
        $setExtraData = [$this->sport => $club->sports_id, $this->club => $club->id, $this->user => $userID];
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
    public function edit(Club $club, Atlet $atlet)
    {
        //
        $nomors = Nomor::where($this->sport, $club->sports_id)->get();
        $lists = $atlet->with('users')->find($atlet->id);

        return view('backend.pages.club.atlet.edit-atlet', compact('club', 'nomors', 'lists', 'atlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtletRequest $request, Club $club, Atlet $atlet)
    {
        //
        $user = $this->userAs->updateData($request, [], User::findOrFail($request->users_id));
        $setExtraData = [$this->sport => $club->sports_id, $this->club => $club->id];
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
    public function destroy(Club $club, Atlet $atlet)
    {
        //
        $user = $this->userAs->deleteData(User::findOrFail($atlet->users_id));
        $delete = $this->atlet->deleteData($atlet);

        if($delete && $user){
            $data = [
                'success' => true,
                'messages' => "Atlet deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Atlet deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
