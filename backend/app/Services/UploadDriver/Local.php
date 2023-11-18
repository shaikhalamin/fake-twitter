<?php

namespace App\Services\UploadDriver;

use App\Services\Interfaces\FileInterface;
use Illuminate\Support\Facades\File;

class Local implements FileInterface
{
    public function upload($file, $options = ['type' => 'user'])
    {
        $fileName = md5(now()) . '.' . $file->getClientOriginalExtension();
        $path = '/uploads/files/' . $options['type'];
        $fileUrl = config('app.url') . ':' . config('app.host_port') . $path . '/' . $fileName;
        $file->move(public_path($path), $fileName);

        $uploadedData = [
            'image_id' => $path . '/' . $fileName,
            'avatar' => $fileUrl,
        ];

        return $uploadedData;
    }

    public function destroy($imageId)
    {
        if (File::exists(public_path($imageId))) {
            File::delete(public_path($imageId));
        }

        return true;
    }
}
