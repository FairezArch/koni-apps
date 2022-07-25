<?php

namespace App\Repository\Nomor;

use App\Models\Nomor as NomorModel;

class EloquentRepository implements TheRepository 
{
    protected $model;

    public function __construct(NomorModel $nomor)
    {
        # code...
        $this->model = $nomor;
    }

    public function storeData($request, $extraData)
    {
        # code...
        $setInputData = [
            'nomor_code' => $request->nomor_code,
            'status' => $request->status
        ];

        return $this->model->store(array_merge($setInputData, $extraData));
    }
    public function updateData($request, $extraData, $modelData)
    {
        # code...
        $setInputData = [
            'nomor_code' => $request->nomor_code,
            'status' => $request->status
        ];

        return $this->modelData->store(array_merge($setInputData, $extraData));
    }
    public function deleteData($modelData)
    {
        # code...
        return $modelData->delete();
    }
}