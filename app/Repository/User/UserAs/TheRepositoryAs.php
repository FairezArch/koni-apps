<?php

namespace App\Repository\User\UserAs;

interface TheRepositoryAs {
    public function storeData($request, $extraData);
    public function updateData($request, $extraData, $modelData);
    public function deleteData($modelData);
}