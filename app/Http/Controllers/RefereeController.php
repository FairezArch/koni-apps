<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sport;
use App\Models\Referee;
use App\Models\MediaModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\SettingJudgeReferee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRefereeRequest;
use App\Models\SettingJudgeRefereeLicence;
use App\Http\Requests\UpdateRefereeRequest;

class RefereeController extends Controller
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
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Referee::IndexPage();
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
                ->addColumn('certificate', function ($row) {
                    return $row->setting_judge_referees->certificate_name . '|###|' . $row->setting_judge_referee_licences->licence_name . '|###|' . Carbon::parse($row->exp_certificate)->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name', 'cabor', 'certificate', 'action'])
                ->make(true);
        }

        return view('backend.pages.referee.index-referee');
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
        $certificates = SettingJudgeReferee::all();
        $licences = SettingJudgeRefereeLicence::all();
        return view('backend.pages.referee.add-referee', compact('sports', 'certificates', 'licences'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRefereeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRefereeRequest $request)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'referee';
        $section = 'insert';
        $selectRole = 6;

        $roleUser = Role::find($selectRole);
        $saveUser = User::create([
            'name' => $request->referee_name,
            'place_born' => $request->place_born,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'email' => Str::random(40) . '@example.net',
            'password' => Hash::make('referee123321')
        ]);
        $saveUser->assignRole($roleUser->name);
        $lastInsertedId = $saveUser->id;

        $save = Referee::create([
            'users_id' => $lastInsertedId,
            'sports_id' => $request->sports_id,
            'domicile' => $request->domicile_address,
            'nik_referees' => $request->nik,
            'file_ktp_referee' => $mediaModel->AddMedia($request->file_ktp_referee, $folder, $section),
            'npwp_referee' => $request->npwp_number,
            'file_npwp_referee' => $mediaModel->AddMedia($request->npwp_file, $folder, $section),
            'setting_judge_referees_id' => $request->certificate_profession,
            'setting_judge_referee_licences_id' => $request->licence,
            'certificate_number' => $request->certificate_number,
            'exp_certificate' => $request->exp_certificate,
            'file_certificate_referee' => $mediaModel->AddMedia($request->certificate_file, $folder, $section),
        ]);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Referee created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Referee created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function show(Referee $referee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = Referee::findRefereeUsers($id);
        $sports = Sport::all();
        $certificates = SettingJudgeReferee::all();
        $licences = SettingJudgeRefereeLicence::all();
        return view('backend.pages.referee.edit-referee', compact('lists', 'sports', 'certificates', 'licences'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRefereeRequest  $request
     * @param  \App\Models\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRefereeRequest $request, $id)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'referee';
        $section = 'update';

        $upUsers = User::find($request->users_id);
        $upUsers->update([
            'name' => $request->referee_name,
            'place_born' => $request->place_born,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address
        ]);

        $up = Referee::find($id);
        $filename = $up->file_ktp_referee;
        $filename1 = $up->file_npwp_referee;
        $filename2 = $up->file_certificate_referee;

        if ($request->hasFile('file_ktp_referee')) {
            $filename = $mediaModel->AddMedia($request->file_ktp_referee, $folder, $section, $filename);
        }
        if ($request->hasFile('npwp_file')) {
            $filename1 = $mediaModel->AddMedia($request->npwp_file, $folder, $section, $filename1);
        }
        if ($request->hasFile('certificate_file')) {
            $filename2 = $mediaModel->AddMedia($request->certificate_file, $folder, $section, $filename2);
        }

        $up->update([
            'users_id' => $request->users_id,
            'sports_id' => $request->sports_id,
            'domicile' => $request->domicile_address,
            'nik_referees' => $request->nik,
            'file_ktp_referee' => $filename,
            'npwp_referee' => $request->npwp_number,
            'file_npwp_referee' => $filename1,
            'setting_judge_referees_id' => $request->certificate_profession,
            'setting_judge_referee_licences_id' => $request->licence,
            'certificate_number' => $request->certificate_number,
            'exp_certificate' => $request->exp_certificate,
            'file_certificate_referee' => $filename2,
        ]);

        if ($up) {
            $data = [
                'success' => true,
                'messages' => "Referee updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Referee updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'referee';

        $del = Referee::find($id);
        $delUser = User::find($del->users_id);
        DB::table('model_has_roles')->where('model_id', $del->users_id)->delete();

        if (!empty($del->file_ktp_referee)) {
            $mediaModel->deleteMedia($folder, $del->file_ktp_referee);
        }
        if (!empty($del->file_npwp_referee)) {
            $mediaModel->deleteMedia($folder, $del->file_npwp_referee);
        }
        if (!empty($del->file_certificate_referee)) {
            $mediaModel->deleteMedia($folder, $del->file_certificate_referee);
        }
        
        $delUser->delete();
        $del->delete();

        if ($del) {
            $data = [
                'success' => true,
                'messages' => "Referee deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Referee deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
