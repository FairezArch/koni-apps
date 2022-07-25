<?php

namespace App\Repository\Nomor;

interface TheRepository {
    public function storeData($request, $extraData);
    public function updateData($request, $extraData, $modelData);
    public function deleteData($modelData);
}