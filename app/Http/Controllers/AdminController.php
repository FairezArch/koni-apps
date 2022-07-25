<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employ;
use App\Models\MediaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;

class AdminController extends Controller
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
    public function index(Request $request, User $users)
    {
        //
        if ($request->ajax()) {
            $data = User::RoleUser();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $url = asset("storage/users/" . $row->photo);
                    $temp = '<div class="d-flex">
                                <div class="images_wrapp mr-2">
                                    <img src=\'' . $url . '\' alt="image" border="0" width="40" class="img-rounded img-thumbnail" align="center" />
                                </div>
                                <div>' . $this->attrFormat($row->name, ucfirst($row->roleName)) . '</div>
                            </div>';
                    return $temp;
                })
                ->addColumn('task', function ($row) {
                    return $this->attrFormat($row->sk_number, Carbon::parse($row->sk_date_to)->translatedFormat('d F Y'));
                })
                ->addColumn('contact_person', function ($row) {
                    return $this->attrFormat($row->email, $row->phone_number);
                })
                ->addColumn('roleColumn', function ($row) {
                    ($row->status == 1) ? $view = 'Aktif' : $view = 'Tidak Aktif';
                    $temps = '<div class="badge badge-success p-1">' . $view . '</div>';
                    return '<div class="text-center">' . $this->attrFormat(ucfirst($row->roleName), $temps) . '</div>';
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name', 'task', 'contact_person', 'roleColumn', 'action'])
                ->make(true);
        }

        return view('backend.pages.admins.index-admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::all();
        $employs = Employ::all();
        return view('backend.pages.admins.add-admin', compact('role', 'employs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreadminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadminRequest $request)
    {
        $mediaModel = new MediaModel();
        $folder = 'users';
        $section = 'insert';
        $role = Role::find($request->userRole);
        $pass = Hash::make($request->password);
        $save = User::create([
            'name' => $request->name,
            'photo' => $mediaModel->AddMedia($request->file, $folder, $section),
            'place_born' => $request->placeBorn,
            'date_of_birth' => $request->dateBorn,
            'gender' => $request->gender,
            'address' => $request->address,
            'sk_number' => $request->sk_no,
            'sk_file' => $mediaModel->AddMedia($request->file_second, $folder, $section),
            'sk_date_from' => $request->datefrom,
            'sk_date_to' => $request->dateto,
            'position' => $request->position,
            'status' => $request->status,
            'phone_number' => $request->phoneNum,
            'email' => $request->email,
            'password' => $pass
        ]);
        $save->assignRole($role->name);

        $email_data = array(
            'title' => 'Berikut Password untuk login ke KONI',
            'email' => $request->email,
            'name' => $request->firstname . $request->lastname,
            'password' => $request->password
        );

        Mail::send('email.mail', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Pemberitahuan Password')
                ->from(config('mail.from.address'), config('mail.from.name'));
        });

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Admin created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Admin created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employs = Employ::all();
        $role = Role::all();
        $lists = User::find($id);
        $roleuser = DB::table('model_has_roles')->where('model_id', $id)->first();
        return view('backend.pages.admins.edit-admin', compact('lists', 'role', 'roleuser', 'employs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateadminRequest  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateadminRequest $request, $id)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'users';
        $section = 'update';

        $user = User::find($id);
        $filename = $user->photo;
        $filename1 = $user->sk_file;

        if ($request->hasFile('file')) {
            $filename = $mediaModel->AddMedia($request->file, $folder, $section, $filename);
        }
        if ($request->hasFile('file_second')) {
            $filename1 = $mediaModel->AddMedia($request->file_second, $folder, $section, $filename1);
        }

        if (empty($request->pass)) {
            $pass = $user->password;
        } else {
            $pass = Hash::make($request->pass);
        }
        $role = Role::find($request->userRole);
        $user->update([
            'name' => $request->name,
            'photo' => $filename,
            'place_born' => $request->placeBorn,
            'date_of_birth' => $request->dateBorn,
            'gender' => $request->gender,
            'address' => $request->address,
            'sk_number' => $request->sk_no,
            'sk_file' => $filename1,
            'sk_date_from' => $request->datefrom,
            'sk_date_to' => $request->dateto,
            'position' => $request->position,
            'status' => $request->status,
            'phone_number' => $request->phoneNum,
            'email' => $request->email,
            'password' => $pass
        ]);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($role->name);

        if ($user) {
            $data = [
                'success' => true,
                'messages' => "Admin updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Admin updated unsuccessfully"
            ];
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mediaModel = new MediaModel();
        $folder = 'users';
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        if (!empty($user->photo)) {
            $mediaModel->deleteMedia($folder, $user->photo);
        }
        if (!empty($user->sk_file)) {
            $mediaModel->deleteMedia($folder, $user->sk_file);
        }

        $user->delete();

        if ($user) {
            $data = [
                'success' => true,
                'messages' => "Admin deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Admin deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}
