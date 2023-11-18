<?php

namespace App\Services\File;

use App\Factories\FileFactory;
use Illuminate\Support\Facades\File;

class FileService
{
    private $uploadDriver;

    public function __construct()
    {
        $this->uploadDriver = config('app.upload_driver');
    }

    public function upload($file, $options = [])
    {
        $fileUploadFactory = FileFactory::create($this->uploadDriver);
        return $fileUploadFactory->upload($file, $options);
    }

    public function destroy($id)
    {
        $fileUploadFactory = FileFactory::create($this->uploadDriver);
        return $fileUploadFactory->destroy($id);
    }
}
