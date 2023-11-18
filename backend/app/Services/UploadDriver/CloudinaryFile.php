<?php

namespace App\Services\UploadDriver;

use App\Services\Interfaces\FileInterface;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class CloudinaryFile implements FileInterface
{
    public function upload($file, $options = ['type' => 'user'])
    {
        $cloudinaryEngine = new CloudinaryEngine();

        $appEnv = config('app.env');
        $uploadFolder = 'twitter/' . $options['type'];
        if ($appEnv !== 'production') {
            $uploadFolder .= '_' . $appEnv;
        }
        $cnEngine = $cloudinaryEngine->upload($file->getRealPath(), ['folder' => $uploadFolder]);

        $uploadedData = [
            'image_id' => $cnEngine->getPublicId(),
            'avatar' => $cnEngine->getSecurePath(),
        ];

        return $uploadedData;
    }

    public function destroy($id)
    {
        $cloudinaryEngine = new CloudinaryEngine();
        return $cloudinaryEngine->destroy($id);
    }
}
