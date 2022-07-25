<?php 

namespace App\Repository\TeamSupport;

interface TeamSupportRepository
{
    public function indexData($param, $set);
    public function storeData($request, $extraData);
    public function updateData($request, $modelData, $extraData);
    public function deleteData($modelData);
}