<?php 

namespace App\Repository\Gallery;

interface GalleryRepository
{
    public function indexData($param, $set);
    public function storeData($request, $sport_id, $extraData);
    public function deleteData($dataModel);
}