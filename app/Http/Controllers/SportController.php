<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sport;
use App\Models\MediaModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreSportRequest;
use App\Http\Requests\UpdateSportRequest;

class SportController extends Controller
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
    public function index(Request $request, Sport $sport)
    {
        //
        if ($request->ajax()) {
            $data = Sport::IndexPage();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('cabor', function (Sport $row) {
                    $url = asset("storage/sport/" . $row->file_sport);
                    $temp = '<div class="d-flex">
                                <div class="images_wrapp mr-2">
                                    <img src="' . $url . '" border="0" width="40" class="img-rounded img-thumbnail" align="center" />
                                </div>
                                <div>
                                    ' . $this->attrFormat('<a href="'.route('sport-branch.show',$row->id).'">'.$row->sportbranch_name.'</a>', $row->users->name.'<br />'.$row->short_organization) . '
                                </div>
                            </div>';
                    return $temp;
                })
                ->addColumn('atlet', function (Sport $row) {
                    return $row->atlets->count() . ' Atlet';
                })
                ->addColumn('trainner', function (Sport $row) {
                    return $row->trainers->count() . ' Pelatih';
                })
                ->addColumn('jugment', function (Sport $row) {
                    return $this->attrFormat($row->referees->count() . ' Wasit', $row->judges->count() . ' Juri');
                })
                ->addColumn('action', function (Sport $row) {
                    return $row->id;
                })
                ->rawColumns(['cabor', 'atlet', 'trainner', 'jugment', 'action'])
                ->make(true);
        }
        return view('backend.pages.sportBranch.index-sportBranch');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $optionRole = 4;
        $selects = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();
        return view('backend.pages.sportBranch.add-sportBranch', compact('selects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSportRequest $request, MediaModel $mediaModel)
    {
        //
        $folder = 'sport';
        $section = 'insert';
        $filename = $mediaModel->AddMedia($request->file_sport, $folder, $section);
        $save = Sport::create([
            'sportbranch_name' => $request->sportbranch_name,
            'slug' => Str::slug($request->sportbranch_name),
            'address' => $request->address,
            'email' => $request->email,
            'phone_number_sport' => $request->phone_number_sport,
            'file_sport' => $filename,
            'users_id' => $request->users_id,
            'sk_number' => $request->sk_number,
            'desc_sportbranch' => $request->desc_sportbranch,
            'organization' => $request->organization,
            'short_organization' => $request->short_organization,
        ]);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Sport created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Sport created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sport = Sport::with(['clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges'])->find($id);
        $clubs = $sport->clubs->count();
        $nomors = $sport->nomors->count();
        $atlets = $sport->atlets->count();
        $trainers = $sport->trainers->count();
        $referees = $sport->referees->count();
        $judges = $sport->judges->count();


        return view('backend.pages.sportBranch.detail-sportBranch', compact('sport', 'clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $optionRole = 4;
        $selects = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();
        $lists = Sport::findOrFail($id);

        return view('backend.pages.sportBranch.edit-sportBranch', compact('selects', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSportRequest  $request
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSportRequest $request, Sport $sport, MediaModel $mediaModel, $id)
    {
        //
        $folder = 'sport';
        $section = 'update';

        $userInfo = json_decode($request->users_id);
        $update = $sport::find($id);
        $filename = $update->file_sport;
        if ($request->hasFile('file_sport')) {
            $filename = $mediaModel->AddMedia($request->file_sport, $folder, $section, $filename);
        }

        $update->update([
            'sportbranch_name' => $request->sportbranch_name,
            'slug' => Str::slug($request->sportbranch_name),
            'address' => $request->address,
            'email' => $request->email,
            'phone_number_sport' => $request->phone_number_sport,
            'file_sport' => $filename,
            'users_id' => $userInfo[0],
            'sk_number' => $userInfo[1],
            'desc_sportbranch' => $request->desc_sportbranch,
            'organization' => $request->organization,
            'short_organization' => $request->short_organization,
        ]);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "Sport updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Sport updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport, $id)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'sport';
        
        $del = $sport::find($id);
        if (!empty($del->file_sport)) {
            $filename = $mediaModel->deleteMedia($folder, $del->file_sport);
        }
        $del->delete();

        if ($del) {
            $data = [
                'success' => true,
                'messages' => "Sport deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Sport deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Duplicate edit to update for profile sport branch
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */

    public function editProfile($id)
    {
        //
        $optionRole = 4;
        $selects = User::leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')->where('model_has_roles.role_id', $optionRole)->get();
        $lists = Sport::findOrFail($id);

        return view('backend.pages.sportBranch.profile.edit-sportBranch', compact('selects', 'lists'));
    }

    public function showProfile($id)
    {
        //
        $sport = Sport::with(['clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges', 'users'])->find($id);
        $clubs = $sport->clubs->count();
        $nomors = $sport->nomors->count();
        $atlets = $sport->atlets->count();
        $trainers = $sport->trainers->count();
        $referees = $sport->referees->count();
        $judges = $sport->judges->count();


        return view('backend.pages.sportBranch.profile.detail-profileSportBranch', compact('sport', 'clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges'));
    }

    public function updateProfile(UpdateSportRequest $request, Sport $sport, MediaModel $mediaModel, $id)
    {
        //
        $folder = 'sport';
        $section = 'update';

        $userInfo = json_decode($request->users_id);
        $update = $sport::find($id);
        $filename = $update->file_sport;
        if ($request->hasFile('file_sport')) {
            $filename = $mediaModel->AddMedia($request->file_sport, $folder, $section, $filename);
        }

        $update->update([
            'sportbranch_name' => $request->sportbranch_name,
            'slug' => Str::slug($request->sportbranch_name),
            'address' => $request->address,
            'email' => $request->email,
            'phone_number_sport' => $request->phone_number_sport,
            'file_sport' => $filename,
            'users_id' => $userInfo[0],
            'sk_number' => $userInfo[1],
            'desc_sportbranch' => $request->desc_sportbranch,
            'organization' => $request->organization,
            'short_organization' => $request->short_organization,
        ]);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "Sport updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Sport updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
