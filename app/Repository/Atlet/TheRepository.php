<?php

namespace App\Repository\Atlet;

interface TheRepository {
    public function storeData($request, $extraData);
    public function updateData($request, $extraData, $modelData);
    public function deleteData($modelData);
    public function achievement($request, $sports_id, $atlet_id);
}

