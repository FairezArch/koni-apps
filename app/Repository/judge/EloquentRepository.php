<?php

namespace App\Repository\Judge;

use App\Models\Judge;
use App\Models\MediaModel;

class EloquentRepository implements TheRepository
{
    protected $model;
    protected $upload;
    protected $folderUpload;
    protected $sectionInsert;
    protected $sectionUpdate;

    public function __construct(Judge $judge, MediaModel $media)
    {
        # code...
        $this->model = $judge;
        $this->upload = $media;
        $this->folderUpload = 'judge';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'update';
    }

    public function storeData($request, $extraData)
    {
        # code...
        $judge_ktp = $this->upload->AddMedia($request->file_ktp_judge, $this->folderUpload, $this->sectionInsert);
        $judge_npwp = $this->upload->AddMedia($request->file_npwp, $this->folderUpload, $this->sectionInsert);
        $judge_certificate = $this->upload->AddMedia($request->certificate_file, $this->folderUpload, $this->sectionInsert);

        $setInputData = [
            'nomor_id' => $request->nomors_id,
            'domicile' => $request->domicile_address,
            'nik_judge' => $request->nik,
            'file_ktp_judge' => $judge_ktp,
            'npwp_judge' => $request->npwp_number,
            'file_npwp_judge' => $judge_npwp,
            'setting_judge_referees_id' => $request->certificate_profession,
            'setting_judge_referee_licences_id' => $request->licence,
            'certificate_number' => $request->certificate_number,
            'exp_certificate' => $request->exp_certificate,
            'file_certificate_judge' => $judge_certificate
        ];

        return $this->model->create(array_merge($setInputData, $extraData));
    }
    public function updateData($request, $extraData, $modelData)
    {
        # code...
        $judge_ktp = $modelData->file_ktp_judge;
        $judge_npwp = $modelData->file_npwp_judge;
        $judge_certificate = $modelData->file_certificate_judge;

        if ($request->hasFile('file_ktp_judge')) {
            $judge_ktp = $this->upload->AddMedia($request->file_ktp_judge, $this->folderUpload, $this->sectionUpdate, $judge_ktp);
        }
        if ($request->hasFile('file_npwp')) {
            $judge_npwp = $this->upload->AddMedia($request->file_npwp, $this->folderUpload, $this->sectionUpdate, $judge_npwp);
        }
        if ($request->hasFile('certificate_file')) {
            $judge_certificate = $this->upload->AddMedia($request->certificate_file, $this->folderUpload, $this->sectionUpdate, $judge_certificate);
        }

        $setInputData = [
            'nomor_id' => $request->nomors_id,
            'domicile' => $request->domicile_address,
            'nik_judge' => $request->nik,
            'file_ktp_judge' => $judge_ktp,
            'npwp_judge' => $request->npwp_number,
            'file_npwp_judge' => $judge_npwp,
            'setting_judge_referees_id' => $request->certificate_profession,
            'setting_judge_referee_licences_id' => $request->licence,
            'certificate_number' => $request->certificate_number,
            'exp_certificate' => $request->exp_certificate,
            'file_certificate_judge' => $judge_certificate
        ];

        return $modelData->update(array_merge($setInputData, $extraData));
    }
    public function deleteData($modelData)
    {
        # code...
        if (!empty($modelData->file_ktp_judge)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_ktp_judge);
        }

        if (!empty($modelData->file_npwp_judge)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_npwp_judge);
        }

        if (!empty($modelData->file_certificate_judge)) {
            $this->upload->deleteMedia($this->folderUpload, $modelData->file_certificate_judge);
        }

        return $modelData->delete();
    }
}
