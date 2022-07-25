<?php

namespace App\Repository\TeamSupport;

use App\Models\User;
use App\Models\MediaModel;
use App\Models\TeamSupport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EloquentTeamSupportRepository implements TeamSupportRepository
{
    protected $model;
    protected $upload;
    protected $folderUpload;
    protected $sectionInsert;
    protected $sectionUpdate;
    private $user_id;

    public function __construct(TeamSupport $teamSupport, MediaModel $media)
    {
        # code...
        $this->model = $teamSupport;
        $this->upload = $media;
        $this->folderUpload = 'users';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'upload';
        $this->user_id = 'users_id';
    }

    public function indexData($param, $set)
    {
        # code...
        return $this->model->where($param, $set);
    }

    public function storeData($request, $getInput)
    {
        # code...
        $getRole = Role::find($request->role);
        $saveUser = User::create([
            'name' => $request->name,
            'photo' => $this->upload->AddMedia($request->photo, $this->folderUpload, $this->sectionInsert),
            'place_born' => $request->placeBorn,
            'date_of_birth' => $request->dateBorn,
            'gender' => $request->gender,
            'address' => $request->address,
            'sk_number' => $request->sk_no,
            'sk_file' => $this->upload->AddMedia($request->sk_file, $this->folderUpload, $this->sectionInsert),
            'sk_date_from' => $request->datefrom,
            'sk_date_to' => $request->dateto,
            'position' => $request->position,
            'status' => $request->status,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $saveUser->assignRole($getRole->name);
        $lastInsertedId = $saveUser->id;

        $setInputData = [$this->user_id => $lastInsertedId];

        $detailEmail = array(
            'title' => 'Berikut Password untuk login ke KONI',
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password
        );

        Mail::send('email.mail', $detailEmail, function ($message) use ($detailEmail) {
            $message->to($detailEmail['email'], $detailEmail['name'])
                ->subject('Pemberitahuan Password')
                ->from(config('mail.from.address'), config('mail.from.name'));
        });

        return $this->model->create(array_merge($setInputData, $getInput));
    }

    public function updateData($request, $modelData, $getInput)
    {
        # code...
        $user = User::find($request->user_id);
        $filename = $user->photo;
        $filename_sk = $user->photo;

        if ($request->hasFile('photo')) {
            $filename = $this->upload->AddMedia($request->photo, $this->folderUpload, $this->sectionUpdate, $filename);
        }

        if ($request->hasFile('sk_file')) {
            $filename_sk = $this->upload->AddMedia($request->sk_file, $this->folderUpload, $this->sectionUpdate, $filename_sk);
        }

        if (empty($request->password)) {
            $pass = $user->password;
        } else {
            $pass = Hash::make($request->password);

            $detailEmail = array(
                'title' => 'Berikut Password untuk login ke KONI',
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->password
            );

            Mail::send('email.mail', $detailEmail, function ($message) use ($detailEmail) {
                $message->to($detailEmail['email'], $detailEmail['name'])
                    ->subject('Pemberitahuan Password')
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });
        }

        $getRole = Role::find($request->role);
        $user->update([
            'name' => $request->name,
            'photo' => $filename,
            'place_born' => $request->placeBorn,
            'date_of_birth' => $request->dateBorn,
            'gender' => $request->gender,
            'address' => $request->address,
            'sk_number' => $request->sk_no,
            'sk_file' => $filename_sk,
            'sk_date_from' => $request->datefrom,
            'sk_date_to' => $request->dateto,
            'position' => $request->position,
            'status' => $request->status,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'password' => $pass
        ]);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($getRole->name);
        $setInputData = [$this->user_id => $user->id];

        return $modelData->update(array_merge($setInputData, $getInput));
    }

    public function deleteData($modelData)
    {
        # code...
        $user = User::find($modelData->user_id);
        $filename = $user->photo;

        if ($filename) {
            $this->upload->deleteMedia($this->folderUpload, $filename);
        }

        DB::table('model_has_roles')->where('model_id', $modelData->user_id)->delete();
        

        return $modelData->delete() && $user->delete();
    }
}
