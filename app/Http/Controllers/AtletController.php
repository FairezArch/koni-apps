<?php

# check again if this file not use anymore

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Club;
use App\Models\User;
use App\Models\Atlet;
use App\Models\Nomor;
use App\Models\Sport;
use App\Models\MediaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Repository\Atlet\EloquentRepository;

class AtletController extends Controller
{
    protected $atlet;

    public function __construct(EloquentRepository $repository)
    {
        # code...
        $this->atlet = $repository;
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
    public function index(Request $request)
    {
        //
        // return $data;
        if ($request->ajax()) {
            $data = Atlet::where('verify_atlet', 1)->with(['users', 'sports']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $dateNow = Carbon::now();
                    $date_born = Carbon::parse($row->users->date_of_birth);
                    $age = $date_born->diffInYears($dateNow);
                    return $this->attrFormat($row->users->name, $age . ' Tahun');
                })
                ->addColumn('cabor', function ($row) {
                    return $row->sports->sportbranch_name;
                })
                ->addColumn('trainingplace', function ($row) {
                    return $row->training_place;
                })
                ->addColumn('internasional', function ($row) {
                    return $row->id;
                })
                ->addColumn('nasional', function ($row) {
                    return $row->id;
                })
                ->addColumn('daerah', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name', 'cabor', 'trainingplace', 'internasional', 'nasional', 'daerah', 'action'])
                ->make(true);
        }
        return view('backend.pages.atlet.index-atlet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sports = Sport::all();
        $clubs = Club::all();
        $nomors = Nomor::all();
        return view('backend.pages.atlet.add-atlet', compact('sports', 'clubs', 'nomors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAtletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtletRequest $request)
    {
        //
        $save = $this->atlet->storeData($request, []);
        // $mediaModel = new MediaModel();
        // $folder = 'atlet';
        // $section = 'insert';
        // $selectRole = 6;

        // $roleUser = Role::find($selectRole);
        // $saveUser = User::create([
        //     'name' => $request->name_atlet,
        //     'place_born' => $request->place_born,
        //     'date_of_birth' => $request->date_of_birth,
        //     'email' =>  Str::random(40) . '@example.net',
        //     'password' => Hash::make('atlet123321')
        // ]);
        // $saveUser->assignRole($roleUser->name);
        // $lastInsertedId = $saveUser->id;

        // $save = Atlet::create([
        //     'users_id' => $lastInsertedId,
        //     'nik' => $request->nik,
        //     'ktp_address' => $request->ktp_address,
        //     'domicile_address' => $request->domicile_address,
        //     'sports_id' => $request->sports_id,
        //     'clubs_id' => $request->clubs_id,
        //     'nomors_id' => $request->nomors_id,
        //     'training_place' => $request->training_place,
        //     'status_atlet' => $request->status_atlet,
        //     'file_ktp_atlet' => $mediaModel->AddMedia($request->file_ktp_atlet, $folder, $section),
        //     'file_sk_training' => $mediaModel->AddMedia($request->file_sk_training, $folder, $section),
        //     'file_npwp' => $mediaModel->AddMedia($request->file_npwp, $folder, $section),
        //     'file_atlet_status' => $mediaModel->AddMedia($request->file_atlet_status, $folder, $section),
        //     'nomor_nik_ktp' => $request->nomor_ktp,
        //     'nomor_sk_training' => $request->nomor_sk_training,
        //     'nomor_npwp' => $request->nomor_npwp,
        //     'nomor_status_atlet' => $request->nomor_status_atlet,
        //     'verify_atlet' => 1
        // ]);

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
     * @param  \App\Models\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function show(Atlet $atlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sports = Sport::all();
        $clubs = Club::all();
        $nomors = Nomor::all();
        $lists = Atlet::with('users')->find($id);
        return view('backend.pages.atlet.edit-atlet', compact('sports', 'clubs', 'nomors', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAtletRequest  $request
     * @param  \App\Models\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtletRequest $request, $id)
    {
        //
        $update = $this->atlet->updateData($request, [], Atlet::find($id));
        $mediaModel = new MediaModel();
        $folder = 'atlet';
        $section = 'update';

        $upUser = User::find($request->users_id);
        $upUser->update([
            'name' => $request->name_atlet,
            'place_born' => $request->place_born,
            'date_of_birth' => $request->date_of_birth,
            // 'email' =>  Str::random(40) . '@example.net',
        ]);

        $update = Atlet::find($id);
        $filename = $update->file_ktp_atlet;
        $filename1 = $update->file_sk_training;
        $filename2 = $update->file_npwp;
        $filename3 = $update->file_atlet_status;

        if ($request->hasFile('file_ktp_atlet')) {
            $filename = $mediaModel->AddMedia($request->file_ktp_atlet, $folder, $section, $filename);
        }
        if ($request->hasFile('file_sk_training')) {
            $filename1 = $mediaModel->AddMedia($request->file_sk_training, $folder, $section, $filename1);
        }
        if ($request->hasFile('file_npwp')) {
            $filename2 = $mediaModel->AddMedia($request->file_npwp, $folder, $section, $filename2);
        }
        if ($request->hasFile('file_atlet_status')) {
            $filename3 = $mediaModel->AddMedia($request->file_atlet_status, $folder, $section, $filename3);
        }

        $update->update([
            'users_id' => $request->users_id,
            'nik' => $request->nik,
            'ktp_address' => $request->ktp_address,
            'domicile_address' => $request->domicile_address,
            'sports_id' => $request->sports_id,
            'clubs_id' => $request->clubs_id,
            'nomors_id' => $request->nomors_id,
            'training_place' => $request->training_place,
            'status_atlet' => $request->status_atlet,
            'file_ktp_atlet' => $filename,
            'file_sk_training' => $filename1,
            'file_npwp' => $filename2,
            'file_atlet_status' => $filename3,
            'nomor_nik_ktp' => $request->nomor_ktp,
            'nomor_sk_training' => $request->nomor_sk_training,
            'nomor_npwp' => $request->nomor_npwp,
            'nomor_status_atlet' => $request->nomor_status_atlet
        ]);

        if ($update) {
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
     * @param  \App\Models\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
        $mediaModel = new MediaModel();
        $folder = 'atlet';

        $del = Atlet::find($id);
        $delUser = User::find($del->users_id);
        DB::table('model_has_roles')->where('model_id', $del->users_id)->delete();

        if (!empty($del->file_ktp_atlet)) {
            $mediaModel->deleteMedia($folder, $del->file_ktp_atlet);
        }
        if (!empty($del->file_sk_training)) {
            $mediaModel->deleteMedia($folder, $del->file_sk_training);
        }
        if (!empty($del->file_npwp)) {
            $mediaModel->deleteMedia($folder, $del->file_npwp);
        }
        if (!empty($del->file_atlet_status)) {
            $mediaModel->deleteMedia($folder, $del->file_atlet_status);
        }

        $delUser->delete();
        $del->delete();

        if ($del) {
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
}
