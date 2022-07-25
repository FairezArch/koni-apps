<?php

namespace App\Repository\Atlet;

use App\Models\Atlet;
use App\Models\MediaModel;
use App\Models\Achievement;

class EloquentRepository implements TheRepository
{

    protected $model;
    protected $upload;
    protected $folderUpload;
    protected $sectionInsert;
    protected $sectionUpdate;

    public function __construct(Atlet $atlet, MediaModel $media)
    {
        # code...
        $this->model = $atlet;
        $this->upload = $media;
        $this->folderUpload = 'atlet';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'update';
    }

    public function storeData($request, $extraData)
    {
        # code...
        $file_ktp_atlet = $this->upload->AddMedia($request->file_ktp_atlet, $this->folderUpload, $this->sectionInsert);
        $file_npwp = $this->upload->AddMedia($request->file_npwp, $this->folderUpload, $this->sectionInsert);

        $setInputData = [
            'nik' => $request->nik,
            'ktp_address' => $request->ktp_address,
            'domicile_address' => $request->domicile_address,
            'nomors_id' => $request->nomors_id,
            'training_place' => $request->training_place,
            'file_ktp_atlet' => $file_ktp_atlet,
            'file_npwp' => $file_npwp,
            'nomor_sk_training' => $request->nomor_sk_training,
            'nomor_npwp' => $request->nomor_npwp,
            'nomor_status_atlet' => $request->nomor_status_atlet,
            'status_atlet' => $request->status_atlet,
        ];

        return $this->model->create(array_merge($setInputData, $extraData));
    }

    public function updateData($request, $extraData, $modelData)
    {
        # code...
        $file_ktp_atlet = $modelData->file_ktp_atlet;
        $file_npwp = $modelData->file_npwp;

        if ($request->hasFile('file_ktp_atlet')) {
            $file_ktp_atlet = $this->upload->AddMedia($request->file_ktp_atlet, $this->folderUpload, $this->sectionUpdate, $file_ktp_atlet);
        }

        if ($request->hasFile('file_npwp')) {
            $file_npwp = $this->upload->AddMedia($request->file_npwp, $this->folderUpload, $this->sectionUpdate, $file_npwp);
        }

        $setInputData = [
            'users_id' => $request->users_id,
            'nik' => $request->nik,
            'ktp_address' => $request->ktp_address,
            'domicile_address' => $request->domicile_address,
            'nomors_id' => $request->nomors_id,
            'training_place' => $request->training_place,
            'file_ktp_atlet' => $file_ktp_atlet,
            'file_npwp' => $file_npwp,
            'nomor_sk_training' => $request->nomor_sk_training,
            'nomor_npwp' => $request->nomor_npwp,
            'nomor_status_atlet' => $request->nomor_status_atlet,
            'status_atlet' => $request->status_atlet,
        ];

        return $modelData->update(array_merge($setInputData, $extraData));
    }

    public function deleteData($modelData)
    {
        # code...
        if (!empty($modelData->file_ktp_atlet)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_ktp_atlet);
        }
        if (!empty($modelData->file_npwp)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_npwp);
        }
        
        return $modelData->delete();
    }

    public function achievement($request, $sports_id, $atlet_id)
    {
        # code...
        $folder = 'atlet_achievement';
        $file_achievement = $this->upload->AddMedia($request->file_achievement, $folder, $this->sectionInsert);

        return Achievement::create([
            'nomor_code' => $request->nomor_code,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'sports_id' => $sports_id,
            'nomors_id' => $request->nomors_id,
            'atlets_id' => $atlet_id,
            'achievement_level' => $request->achievement_level,
            'medal' => $request->medal,
            'file_achievement' => $file_achievement,
            'status_achievement' => $request->status_achievement
        ]);
    }
}
