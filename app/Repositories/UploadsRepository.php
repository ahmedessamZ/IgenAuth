<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UploadsRepositoryInterface;
use Illuminate\Http\UploadedFile;

class UploadsRepository implements UploadsRepositoryInterface
{
    public function uploadMedia($model, $file, $collection = 'default')
    {
        return $model->addMedia($file)->toMediaCollection($collection);
    }
}
