<?php 

namespace App\Repository\Judge;

interface TheRepository {
    public function storeData($request, $extraData);
    public function updateData($request, $extraData, $modelData);
    public function deleteData($modelData);
}