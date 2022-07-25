<?php

namespace App\Repository\User\UserAs;

use App\Models\User;
use App\Models\MediaModel;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EloquentRepositoryAs implements TheRepositoryAs
{

    protected $model;
    protected $upload;
    protected $folderUpload;
    protected $sectionInsert;
    protected $sectionUpdate;

    public function __construct(User $user, MediaModel $media)
    {
        # code...
        $this->model = $user;
        $this->upload = $media;
        $this->folderUpload = 'users';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'update';
    }

    public function storeData($request, $extraData)
    {
        # code...
        $role = Role::findOrFail($request->roleID);
        $photo_profile = $this->upload->AddMedia($request->photo_profile, $this->folderUpload, $this->sectionInsert);
        $setInputData = [
            'name' => $request->name_atlet,
            'photo' => $photo_profile,
            'place_born' => $request->place_born,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password)
        ];
        $storeUser = User::create(array_merge($setInputData, $extraData));
        $storeUser->assignRole($role->name);

        return $storeUser->id;
    }

    public function updateData($request, $extraData, $modelData)
    {
        # code...
        $photo_profile = $modelData->photo;

        if ($request->hasFile('photo_profile')) {
            $photo_profile = $this->upload->AddMedia($request->photo_profile, $this->folderUpload, $this->sectionUpdate, $modelData->photo);
        }

        $setInputData = [
            'name' => $request->name_atlet,
            'photo' => $photo_profile,
            'place_born' => $request->place_born,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone,
        ];

        return $modelData->update(array_merge($setInputData, $extraData));
    }

    public function deleteData($modelData)
    {
        # code...
        DB::table('model_has_roles')->where('model_id', $modelData->id)->delete();

        if (!empty($modelData->photo)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->photo);
        }

        return $modelData->delete();
    }
}
