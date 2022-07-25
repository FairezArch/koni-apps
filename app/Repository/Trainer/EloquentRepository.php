<?php

namespace App\Repository\Trainer;

use App\Models\Trainner;
use App\Models\MediaModel;

class EloquentRepository implements TheRepository
{
    protected $model;
    protected $upload;
    protected $folderUpload;
    protected $sectionInsert;
    protected $sectionUpdate;

    public function __construct(Trainner $trainer, MediaModel $media)
    {
        # code...
        $this->model = $trainer;
        $this->upload = $media;
        $this->folderUpload = 'trainer';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'update';
    }


    public function storeData($request, $extraData)
    {
        # code...
        $ktp_trainer = $this->upload->AddMedia($request->file_ktp_trainner, $this->folderUpload, $this->sectionInsert);
        $npwp_trainer = $this->upload->AddMedia($request->file_npwp, $this->folderUpload, $this->sectionInsert);
        $certificate_profession_trainer = $this->upload->AddMedia($request->certificate_file, $this->folderUpload, $this->sectionInsert);

        $setInputData = [
            'nik_trainner' => $request->nik,
            'file_ktp_trainner' => $ktp_trainer,
            'domicile' => $request->domicile_address,
            'npwp_trainner' => $request->nomor_npwp,
            'file_npwp_trainner' => $npwp_trainer,
            'clubs_id' => $request->clubs_id,
            'nomors_id' => $request->nomors_id,
            'status_trainners_id' => $request->status_trainner,
            'certificate_professions_id' => $request->certificate_profession,
            'file_certificate_profession' => $certificate_profession_trainer,
            'status' => $request->status_atlet
        ];

        return $this->model->create(array_merge($setInputData, $extraData));
    }
    public function updateData($request, $extraData, $modelData)
    {
        # code...
        $ktp_trainer = $modelData->file_ktp_trainner;
        $npwp_trainer = $modelData->file_npwp_trainner;
        $certificate_profession_trainer = $modelData->file_certificate_profession;

        if ($request->hasFile('file_ktp_trainner')) {
            $ktp_trainer = $this->upload->AddMedia($request->file_ktp_trainner, $this->folderUpload, $this->sectionUpdate, $ktp_trainer);
        }
        if ($request->hasFile('npwp_file')) {
            $npwp_trainer = $this->upload->AddMedia($request->npwp_file, $this->folderUpload, $this->sectionUpdate, $npwp_trainer);
        }
        if ($request->hasFile('certificate_file')) {
            $certificate_profession_trainer = $this->upload->AddMedia($request->certificate_file, $this->folderUpload, $this->sectionUpdate, $certificate_profession_trainer);
        }

        $setInputData = [
            'nik_trainner' => $request->nik,
            'file_ktp_trainner' => $ktp_trainer,
            'domicile' => $request->domicile_address,
            'npwp_trainner' => $request->nomor_npwp,
            'file_npwp_trainner' => $npwp_trainer,
            'clubs_id' => $request->clubs_id,
            'nomors_id' => $request->nomors_id,
            'status_trainners_id' => $request->status_trainner,
            'certificate_professions_id' => $request->certificate_profession,
            'file_certificate_profession' => $certificate_profession_trainer,
            'status' => $request->status_atlet
        ];

        return $modelData->update(array_merge($setInputData, $extraData));
    }
    public function deleteData($modelData)
    {
        # code...
        if (!empty($modelData->file_ktp_trainner)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_ktp_trainner);
        }
        if (!empty($modelData->file_npwp_trainner)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_npwp_trainner);
        }
        if (!empty($modelData->file_certificate_profession)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_certificate_profession);
        }

        return $modelData->delete();
    }
}
